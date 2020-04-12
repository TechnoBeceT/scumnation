<?php

namespace App\Models\Finance;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    const KILL      = 'Kill';
    const DEATH     = 'Death';
    const PURCHASE  = 'Purchase';
    const ORDER     = 'Order';
    const PLAYTIME  = 'Playtime';
    const DEDUCT    = 'Deduct';
    const ADD       = 'Add';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'type', 'killer_id', 'victim_id', 'amount', 'action_type'
    ];

    public $hidden = ['id', 'user_id'];

    /**
     * Get the owner of this credit.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the killer.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function killer()
    {
        return $this->belongsTo(User::class, 'killer_id');
    }

    /**
     * Get the victim.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function victim()
    {
        return $this->belongsTo(User::class, 'victim_id');
    }
}
