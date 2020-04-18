<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;

class SubscriberPlanContent extends Model
{
    const PACK          = 'Pack';
    const FAMEPOINT     = 'Fame Point';
    const COIN          = 'Coin';
    const VEHICLE       = 'Vehicle';
    const ITEM          = 'Item';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_id', 'type', 'amount', 'item_id', 'pack_type_id', 'days'
    ];

    public $hidden = ['id'];

    /**
     * Get the plan of this content.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(SubscriberPlan::class, 'plan_id');
    }
}
