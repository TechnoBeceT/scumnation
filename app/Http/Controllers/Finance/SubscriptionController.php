<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Finance\Card;
use App\Models\Finance\SubscriberPlan;
use App\Models\Users\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    use ApiResponser;
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(StripeController $stripeController)
    {
        $this->middleware('auth:api');
        $this->stripeController = $stripeController;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriptionRequest $request)
    {
        $user = auth()->user();
        $card = Card::where('user_id', auth()->user()->id)->where('id', $request->payment)->first();
        $plan = SubscriberPlan::where('tier', $request->plan)->first();
        if($request->has('coupon')) { $coupon = $request->coupon; }else { $coupon = null; }
        if($user->subscription) {
            $this->stripeController->cancelSubscription($user->subscription);
            $user->subscription()->delete();
            return $this->stripeController->makeSubscription($plan, $card->card_id, $coupon);
        }else {
            return $this->stripeController->makeSubscription($plan, $card->card_id, $coupon);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $subscription)
    {
        $user = $subscription;

        if($user->id != auth()->user()->id) {
            return $this->errorResponse(__('messages.usersDoesntMatch'), 400);
        }
        if(!$user->subscription) {
            return $this->errorResponse(__('messages.youAreNotSubscriber'), 400);
        }
        try {
            $this->stripeController->cancelSubscription($user->subscription);

            $user->subscription()->update([
                'cancelled' => true,
            ]);
            return $this->successResponse(['message' => __('messages.cancelledSubscribe')], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse(__('messages.cancelledSubscribeFailed'), 400);
        }
    }
}
