<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\Card;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class PurchaseTokenController extends Controller
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
    public function store(Request $request)
    {
        switch ($request->tokens) {
            case 200:
                $amount = 2.99;
                $token = 200;
            break;
            case 400:
                $amount = 3.99;
                $token = 400;
            break;
            case 1000:
                $amount = 8.99;
                $token = 1000;
            break;
            case 1500:
                $amount = 12.99;
                $token = 1500;
            break;
            case 2500:
                $amount = 14.99;
                $token = 2500;
            break;
            case 3500:
                $amount = 24.99;
                $token = 3500;
            break;
            default:
                $amount = 2.99;
                $token = 200;
            break;
        }
        $card = Card::where('user_id', auth()->user()->id)->where('id', $request->payment)->first();
        if(!$card) {
            return $this->errorResponse('Card doesn\'t exist', 400);
        }
        $charge = $this->stripeController->makeCharge($amount, $card->card_id);
        if($charge['captured'] === true)
        {
            if(!auth()->user()->addCredits($token)){
                return $this->errorResponse('Something went wrong.', 400);
            }

            return $this->successResponse(['message' => 'Payment successfully done.', 'tokens' => auth()->user()->credits], 200);
        }
        return $this->errorResponse('Payment cannot taken.', 400);
    }
}
