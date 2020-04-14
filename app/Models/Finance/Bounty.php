<?php

namespace App\Models\Finance;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class Bounty extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount'
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
}
