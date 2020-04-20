<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\Subscriptions;
use App\Models\Users\User;
use App\Traits\ApiResponser;
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
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }catch (CardErrorException $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }catch (NotFoundException $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }catch (InvalidRequestException $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }catch (UnauthorizedException $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }catch (BadRequestException $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
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
            abort($e->getMessage(), $e->getCode());
        }catch (CardErrorException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (NotFoundException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (InvalidRequestException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (UnauthorizedException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (BadRequestException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (\Throwable $th) {
            abort(__('messages.cantCreatePlan'), 400);
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
            abort($e->getMessage(), $e->getCode());
        }catch (CardErrorException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (NotFoundException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (InvalidRequestException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (UnauthorizedException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (BadRequestException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (\Throwable $th) {
            abort(__('messages.cantUpdatePlan'), 400);
        }
        return $stripePlan;
    }

    public function deletePlan($plan)
    {
        try {
            \Stripe::plans()->delete($plan);
        } catch (ServerErrorException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (CardErrorException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (NotFoundException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (InvalidRequestException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (UnauthorizedException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (BadRequestException $e) {
            abort($e->getMessage(), $e->getCode());
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
            abort($e->getMessage(), $e->getCode());
        }catch (CardErrorException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (NotFoundException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (InvalidRequestException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (UnauthorizedException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (BadRequestException $e) {
            abort($e->getMessage(), $e->getCode());
        }

        return $charge;
    }


    //======================================================================
    // SUBSCRIPTONS
    //======================================================================

    public function makeSubscription($plan, $cardId, $coupon = null)
    {
        $user = $this->getUser();
        try {
            $subscription = \Stripe::subscriptions()->create($user->stripe_id, [
                'plan'      => $plan,
                'coupon'    => $coupon,
                'source'    => $cardId,
                'metadata'  => [
                    'user_id' => $user->id,
                    'user_fullname' => $user->fullname(),
                ]
            ]);
        }catch (ServerErrorException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (CardErrorException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (NotFoundException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (InvalidRequestException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (UnauthorizedException $e) {
            abort($e->getMessage(), $e->getCode());
        }catch (BadRequestException $e) {
            abort($e->getMessage(), $e->getCode());
        }
        if(isset($subscription['created']) && isset($subscription['start_date'])) {
            $user->subscription()->create([
                'user_id'               => $user->id,
                'subscription_id'       => $subscription['id'],
                'start_date'            => $subscription['start_date'],
                'current_period_start'  => $subscription['current_period_start'],
                'current_period_end'    => $subscription['current_period_end'],
            ]);
            return $this->successResponse(['message' => __('messages.successfullySubscribed')], 200);
        }else {
            return $this->errorResponse(__('messages.subscribeFailed'), 400);
        }
    }
}
