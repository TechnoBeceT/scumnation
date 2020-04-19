<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class FamePoint extends Model
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
     * Get the owner of this fame points.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
