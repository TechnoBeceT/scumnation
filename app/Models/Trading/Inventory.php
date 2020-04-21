<?php

namespace App\Models\Trading;

use App\Models\Users\User;
use App\Transformers\InventoryTransformer;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $timestamps = false;
    public $transformer = InventoryTransformer::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'item_id', 'amount'
    ];

    /**
     * Get item owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get related item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
