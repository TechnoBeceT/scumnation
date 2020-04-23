<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Finance\StripeController;

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

    /**
     * Handles extending the create method in order to create a stripe plan
     *
     * @param array $attributes
     * @return mixed
     */
    public static function create(array $attributes = [])
    {
        $plan = static::query()->create($attributes);
        $stripeController = new StripeController;
        $stripeController->createPlan($plan);

        return $plan;
    }
}
