<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;

class SubscriberPlan extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stripe_plan_id', 'name', 'price', 'tier','description'
    ];

    public $hidden = ['id', 'stripe_plan_id'];

    /**
     * Get the contents of this plan.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany(SubscriberPlanContent::class, 'plan_id');
    }
}
