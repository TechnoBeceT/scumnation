<?php

namespace App\Models\Trading;

use App\Scopes\MarketPlaceItemScope;

class MarketPlaceItem extends Item
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MarketPlaceItemScope);
    }

    /**
     * Get the item's sale information.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sale()
    {
        return $this->hasOne(Sale::class, 'item_id');
    }
}
