<?php

namespace App\Models\Finance;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'card_id', 'brand', 'last4', 'exp_month', 'exp_year'
    ];

    public $hidden = ['card_id', 'user_id'];

    /**
     * Get the owner of this card.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
