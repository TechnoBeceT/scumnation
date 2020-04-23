<?php

namespace App\Models\Trading;

use App\Scopes\MarketPlaceCategoryTypeScope;

class MarketPlaceCategoryType extends CategoryType
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MarketPlaceCategoryTypeScope);
    }

    /**
     * Get the this type categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marketplacecategories()
    {
        return $this->hasMany(MarketPlaceCategory::class, 'category_type');
    }
}
