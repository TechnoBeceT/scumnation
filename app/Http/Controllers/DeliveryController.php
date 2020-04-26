<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryRequest;
use App\Models\Trading\Item;
use App\Notifications\SpawnItemsNotification;
use App\Traits\Controllers\DeliveryControllerHelper;

class DeliveryController extends Controller
{
    use DeliveryControllerHelper;
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\DeliveryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryRequest $request)
    {
        $user = auth()->user();
        $this->validateDeliveryRequest($request, $user);
        try {
            $commands = [];
            foreach($request->data as $deliver) {
                $item = Item::find($deliver['item_id']);
                $user->removeItem($item->id, $deliver['quantity']);
                $commands[] = $item->spawn_code . ' ' . $deliver['quantity'];
            }
            $user->notify(new SpawnItemsNotification($user, implode(",",$commands)));
        } catch (\Throwable $th) {
            return $this->errorResponse(__('messages.deploymentFailed'), 400);
        }
        return $this->successResponse(['message' => __('messages.deploymentSuccess')], 200);
    }
}
