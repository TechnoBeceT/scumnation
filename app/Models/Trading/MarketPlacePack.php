<?php

namespace App\Models\Trading;

use App\Scopes\MarketPlacePackScope;

class MarketPlacePack extends Pack
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MarketPlacePackScope);
    }

    /**
     * Get the pack's sale information.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sale()
    {
        return $this->hasOne(Pack::class, 'pack_id');
    }
}
