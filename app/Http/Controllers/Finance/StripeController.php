<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\Subscriptions;
use App\Models\Users\User;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Cartalyst\Stripe\Exception\ServerErrorException;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\NotFoundException;
use Cartalyst\Stripe\Exception\InvalidRequestException;
use Cartalyst\Stripe\Exception\UnauthorizedException;
use Cartalyst\Stripe\Exception\BadRequestException;

class StripeController extends Controller
{

    use ApiResponser;

    //-----------------------------------------------------
    // User Data
    //-----------------------------------------------------
    private function getUser()
    {
        $user = auth()->user();
        if ($user->stripe_id === null) {
            $this->createCustomer($user);
            $user = auth()->user();
        }

        return $user;
    }

    //======================================================================
    // CUSTOMER
    //======================================================================

    public function createCustomer(User $user)
    {
        $customer = \Stripe::customers()->create([
            'name' => $user->fullname(),
            'email' => $user->email,
        ]);
        $user->stripe_id = $customer['id'];
        $user->save();
        return $customer;
    }

    //======================================================================
    // CARDS
    //======================================================================

    public function createCard($token)
    {
        $user = $this->getUser();
        try {
            $stripeCard = \Stripe::cards()->create($user->stripe_id, $token);
        } catch (ServerErrorException $e) {
            abort(400, $e->getMessage());
        }catch (CardErrorException $e) {
            abort(400, $e->getMessage());
        }catch (NotFoundException $e) {
            abort(400, $e->getMessage());
        }catch (InvalidRequestException $e) {
            abort(400, $e->getMessage());
        }catch (UnauthorizedException $e) {
            abort(400, $e->getMessage());
        }catch (BadRequestException $e) {
            abort(400, $e->getMessage());
        }

        try {
            $user->cards()->create([
                'card_id'       => $stripeCard['id'],
                'brand'         => $stripeCard['brand'],
                'last4'         => $stripeCard['last4'],
                'exp_month'     => $stripeCard['exp_month'],
                'exp_year'      => $stripeCard['exp_year']
            ]);
            return $this->successResponse(['message' => __('messages.cardAdded'), 'cards' => auth()->user()->cards], 200);
        } catch (\Throwable $th) {
            //return $this->errorResponse(__('messages.cardFailed'), 200);
            return $th;
        }
        
    }

    //======================================================================
    // PLANS
    //======================================================================

    public function createPlan($plan)
    {
        try {
            $stripePlan = \Stripe::plans()->create([
                'id'                   => $plan->tier,
                'name'                 => $plan->name,
                'amount'               => $plan->price,
                'currency'             => 'GBP',
                'interval'             => 'month',
                'statement_descriptor' => $plan->description,
            ]);
        } catch (ServerErrorException $e) {
            abort(400, $e->getMessage());
        }catch (CardErrorException $e) {
            abort(400, $e->getMessage());
        }catch (NotFoundException $e) {
            abort(400, $e->getMessage());
        }catch (InvalidRequestException $e) {
            abort(400, $e->getMessage());
        }catch (UnauthorizedException $e) {
            abort(400, $e->getMessage());
        }catch (BadRequestException $e) {
            abort(400, $e->getMessage());
        }catch (\Throwable $th) {
            abort( 400, __('messages.cantCreatePlan'));
        }
        return $stripePlan;
    }

    public function updatePlan($plan)
    {
        try {
            $stripePlan = \Stripe::plans()->update([
                'name'                 => $plan->name,
                'amount'               => $plan->price,
                'currency'             => 'GBP',
                'interval'             => 'month',
                'statement_descriptor' => $plan->description,
            ]);
        } catch (ServerErrorException $e) {
            abort(400, $e->getMessage());
        }catch (CardErrorException $e) {
            abort(400, $e->getMessage());
        }catch (NotFoundException $e) {
            abort(400, $e->getMessage());
        }catch (InvalidRequestException $e) {
            abort(400, $e->getMessage());
        }catch (UnauthorizedException $e) {
            abort(400, $e->getMessage());
        }catch (BadRequestException $e) {
            abort(400, $e->getMessage());
        }catch (\Throwable $th) {
            abort(400,__('messages.cantUpdatePlan'));
        }
        return $stripePlan;
    }

    public function deletePlan($plan)
    {
        try {
            \Stripe::plans()->delete($plan);
        } catch (ServerErrorException $e) {
            abort(400, $e->getMessage());
        }catch (CardErrorException $e) {
            abort(400, $e->getMessage());
        }catch (NotFoundException $e) {
            abort(400, $e->getMessage());
        }catch (InvalidRequestException $e) {
            abort(400, $e->getMessage());
        }catch (UnauthorizedException $e) {
            abort(400, $e->getMessage());
        }catch (BadRequestException $e) {
            abort(400, $e->getMessage());
        }
        return $this->successResponse(['message' => __('messages.planDeleted')], 200);
    }


    //======================================================================
    // CHARGES
    //======================================================================

    public function makeCharge($amount, $cardId)
    {
        $user = $this->getUser();

        try {
            $charge = \Stripe::charges()->create([
                'customer' => $user->stripe_id,
                'currency' => 'GBP',
                'source'   => $cardId,
                'amount'   => $amount,
                'capture'  => true
            ]);
        } catch (ServerErrorException $e) {
            abort(400, $e->getMessage());
        }catch (CardErrorException $e) {
            abort(400, $e->getMessage());
        }catch (NotFoundException $e) {
            abort(400, $e->getMessage());
        }catch (InvalidRequestException $e) {
            abort(400, $e->getMessage());
        }catch (UnauthorizedException $e) {
            abort(400, $e->getMessage());
        }catch (BadRequestException $e) {
            abort(400, $e->getMessage());
        }

        return $charge;
    }


    //======================================================================
    // SUBSCRIPTONS
    //======================================================================

    public function getSubscription($user, $subscription)
    {
        $stripeSubscription = \Stripe::subscriptions()->find($user->stripe_id, $subscription->subscription_id);
        
        return $stripeSubscription;
    }

    public function makeSubscription($plan, $cardId, $coupon = null)
    {
        $user = $this->getUser();
        try {
            $subscription = \Stripe::subscriptions()->create($user->stripe_id, [
                'plan'      => $plan->tier,
                'coupon'    => $coupon,
                'source'    => $cardId,
                'metadata'  => [
                    'user_id' => $user->id,
                    'user_fullname' => $user->fullname(),
                ]
            ]);
        }catch (ServerErrorException $e) {
            abort(400, $e->getMessage());
        }catch (CardErrorException $e) {
            abort(400, $e->getMessage());
        }catch (NotFoundException $e) {
            abort(400, $e->getMessage());
        }catch (InvalidRequestException $e) {
            abort(400, $e->getMessage());
        }catch (UnauthorizedException $e) {
            abort(400, $e->getMessage());
        }catch (BadRequestException $e) {
            abort(400, $e->getMessage());
        }
        if(isset($subscription['created']) && isset($subscription['start_date'])) {
            $user->subscription()->create([
                'user_id'               => $user->id,
                'plan_id'               => $plan->id,
                'subscription_id'       => $subscription['id'],
                'start_date'            => Carbon::createFromTimestamp($subscription['start_date']),
                'current_period_start'  => Carbon::createFromTimestamp($subscription['current_period_start']),
                'current_period_end'    => Carbon::createFromTimestamp($subscription['current_period_end']),
            ]);
            return $this->successResponse(['message' => __('messages.successfullySubscribed')], 200);
        }else {
            return $this->errorResponse(__('messages.subscribeFailed'), 400);
        }
    }

    public function cancelSubscription($subscription)
    {
        $user = $this->getUser();
        try {
            $subscription = \Stripe::subscriptions()->cancel($user->stripe_id, $subscription->subscription_id, true);
        }catch (ServerErrorException $e) {
            abort(400, $e->getMessage());
        }catch (CardErrorException $e) {
            abort(400, $e->getMessage());
        }catch (NotFoundException $e) {
            abort(400, $e->getMessage());
        }catch (InvalidRequestException $e) {
            abort(400, $e->getMessage());
        }catch (UnauthorizedException $e) {
            abort(400, $e->getMessage());
        }catch (BadRequestException $e) {
            abort(400, $e->getMessage());
        }
        return $this->successResponse(['message' => __('messages.cancelledSubscribe')], 200);
    }
}
