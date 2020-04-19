<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Traits\ApiResponser;

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
            'name' => $user->fullname,
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
        
            $user->cards()->create([
                'card_id'       => $stripeCard['id'],
                'brand'         => $stripeCard['brand'],
                'last4'         => $stripeCard['last4'],
                'exp_month'     => $stripeCard['exp_month'],
                'exp_year'      => $stripeCard['exp_year']
            ]);
            return $this->successResponse(['message' => __('messages.cardAdded'), 'cards' => auth()->user()->cards], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse(__('messages.cardFailed'), 200);
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
            
            return $stripePlan;
        } catch (\Throwable $th) {
            abort(__('messages.cantCreatePlan'), 400);
        }
    }

    public function updatePlan($plan)
    {
        try {
            $stripePlan = \Stripe::plans()->create([
                'name'                 => $plan->name,
                'amount'               => $plan->price,
                'currency'             => 'GBP',
                'interval'             => 'month',
                'statement_descriptor' => $plan->description,
            ]);
            
            return $stripePlan;
        } catch (\Throwable $th) {
            abort(__('messages.cantUpdatePlan'), 400);
        }
    }

    public function deletePlan($plan)
    {
        \Stripe::plans()->delete($plan);
        return $this->successResponse(['message' => __('messages.planDeleted')], 200);
    }


    //======================================================================
    // CHARGES
    //======================================================================

    public function makeCharge($amount, $cardId)
    {
        $user = $this->getUser();
        $charge = \Stripe::charges()->create([
            'customer' => $user->stripe_id,
            'currency' => 'GBP',
            'source'   => $cardId,
            'amount'   => $amount,
            'capture'  => true
        ]);

        return $charge;
    }
}
