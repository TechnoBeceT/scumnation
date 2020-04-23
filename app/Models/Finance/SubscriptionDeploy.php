<?php

namespace App\Models\Finance;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class SubscriptionDeploy extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'subscription_id','date',
    ];

    public $hidden = ['id'];

    /**
     * Get the plan of this content.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(Subscriptions::class, 'subscription_id');
    }

    /**
     * Get the user of this deployment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
