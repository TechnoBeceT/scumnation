<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'last_login', 'last_logout', 'total_deads', 'total_kills', 'kd', 'elo'
    ];

    public $hidden = ['id', 'user_id'];

    /**
     * Get the owner of this statistics.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
