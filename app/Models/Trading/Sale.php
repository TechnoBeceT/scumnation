<?php

namespace App\Models\Trading;

use App\Transformers\SaleTransformer;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $timestamps = false;
    public $transformer = SaleTransformer::class;
    const ITEM     = 'Item';
    const PACK     = 'Pack';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id', 'price', 'daily_limit', 'content_type'
    ];

    /**
     * Get the saled item information.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function realItem()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    /**
     * Get the saled item information.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function realPack()
    {
        return $this->belongsTo(Pack::class, 'pack_id');
    }
}
