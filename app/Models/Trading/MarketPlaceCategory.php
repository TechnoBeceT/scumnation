<?php

namespace App\Models\Trading;

use App\Scopes\MarketPlaceCategoryScope;

class MarketPlaceCategory extends Category
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MarketPlaceCategoryScope);
    }

    /**
     * Get the this category items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marketplaceitems()
    {
        return $this->hasMany(MarketPlaceItem::class, 'category_id');
    }

    /**
     * Get the this category packs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packs()
    {
        return $this->hasMany(Pack::class, 'category_id');
    }
}
