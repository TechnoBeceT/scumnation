<?php

namespace App\Models\Logs;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    const LOGGED_IN = 'login';
    const LOGGED_OUT = 'logout';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'date', 'action',
    ];

    protected $hidden = [
        'user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date'              => 'datetime',
    ];

    /**
     * Get the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
