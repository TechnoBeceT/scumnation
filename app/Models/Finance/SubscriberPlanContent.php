<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;

class SubscriberPlanContent extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_id', 'type', 'amount', 'code', 'days'
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
