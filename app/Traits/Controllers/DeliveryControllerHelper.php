<?php

namespace App\Traits\Controllers;

use App\Http\Requests\DeliveryRequest;
use App\Models\Trading\Inventory;
use App\Models\Users\User;
use App\Traits\ApiResponser;

trait DeliveryControllerHelper
{
    use ApiResponser;

    private function validateDeliveryRequest(DeliveryRequest $request, User $user)
    {
        foreach($request->data as $deliver) {
            $item = Inventory::where('user_id', $user->id)->where('item_id', $deliver['item_id'])->first();
            if(!$item || $item->amount < $deliver['quantity']) {
                abort(400, __('messages.notEnoughItem'));
            }
        }
    }
}
