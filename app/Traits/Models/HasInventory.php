<?php

namespace App\Traits\Models;

use App\Models\Trading\Inventory;

trait HasInventory
{

    /**
     * Get user's virtual inventory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'user_id');
    }

    /**
     * Handles adding items to user inventory
     *
     * @param $amount
     * @return mixed
     */
    public function addItem($id, $amount)
    {
        $item = Inventory::where('user_id', '=', $this->id)->where('item_id', $id)->first();
        if($item) {
            $item->amount = $item->amount + $amount;
            $item->save();
        }else {
            $item = Inventory::create([
                'user_id' => $this->id,
                'item_id' => $id,
                'amount'  => $amount
            ]);
        }
        return $item;
    }

    /**
     * Handles removing item from user inventory
     *
     * @param $amount
     * @return mixed
     */
    public function removeItem($id, $amount)
    {
        $item = Inventory::where('user_id', '=', $this->id)->where('item_id', $id)->first();
        if(!$item) {
            abort(400, __('messages.youDontOwnThisItem'));
        }
        if($item->amount < $amount) {
            abort(400, __('messages.youDontHaveThisMuch'));
        }
        if($item->amount == $amount) {
            $item->delete();
        }else {
            $item->amount = $item->amount - $amount;
            $item->save();
        }
        return $item;
    }
}
