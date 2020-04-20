<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Finance\Card;
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
        if($request->has('coupon')) { $coupon = $request->coupon; }else { $coupon = null; }
        if($user->subscription) {
            return 'have subscribe';
        }else {
            return $this->stripeController->makeSubscription($request->plan, $card->card_id, $coupon);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
