<?php

namespace App\Traits\Models;

use App\Models\Finance\Bounty;
use App\Models\Finance\Card;
use App\Models\Finance\Credit;
use App\Models\Finance\Subscriptions;
use App\Models\Users\FamePoint;
use App\Models\Users\Statistic;

trait UserTrait
{
    /**
     * Get user cards.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany(Card::class, 'user_id');
    }

    /**
     * Get user subscription plan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subscription()
    {
        return $this->hasOne(Subscriptions::class, 'user_id');
    }

    public function fullname()
    {
        return $this->name. ' '. $this->surname;
    }

    /**
     * Handles extending the create method in order to create a User Credits record
     *
     * @param array $attributes
     * @return mixed
     */
    public static function create(array $attributes = [])
    {
        $user = static::query()->create($attributes);
        $credits = new Credit();
        $credits->user_id = $user->id;
        $credits->save();
        $statistics = New Statistic();
        $statistics->user_id = $user->id;
        $statistics->save();
        $bounty = New Bounty();
        $bounty->user_id = $user->id;
        $bounty->save();
        $famePoints = new FamePoint();
        $famePoints->user_id = $user->id;
        $famePoints->save();

        return $user;
    }
}
