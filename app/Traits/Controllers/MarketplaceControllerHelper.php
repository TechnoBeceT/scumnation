<?php

namespace App\Traits\Controllers;

use App\Http\Requests\MarketplacePurchaseRequest;
use App\Models\Trading\Sale;
use App\Models\Users\User;
use App\Traits\ApiResponser;

trait MarketplaceControllerHelper
{
    use ApiResponser;

    private function validatePurchaseRequest(MarketplacePurchaseRequest $request, User $user)
    {
        $totalPrice = 0;
        foreach($request->data as $purchased) {
            $sale = Sale::find($purchased['id']);
            $totalPrice = $totalPrice + ($sale->price * $purchased['quantity']);
        }

        if($totalPrice > $user->credit->amount) {
            abort(400, __('messages.notEnoughTokens'));
        }
    }
}
