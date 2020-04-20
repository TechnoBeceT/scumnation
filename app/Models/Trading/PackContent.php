<?php

namespace App\Models\Trading;

use Illuminate\Database\Eloquent\Model;

class PackContent extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pack_id', 'item_id', 'amount'
    ];

    /**
     * Get related pack.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pack() {
        return $this->belongsTo(Pack::class, 'pack_id');
    }

    /**
     * Get related item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item() {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
