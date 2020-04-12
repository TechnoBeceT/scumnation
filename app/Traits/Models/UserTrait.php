<?php

namespace App\Traits\Models;

use App\Models\Finance\Credit;
use App\Models\Users\Statistic;

trait UserTrait
{

    

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

        return $user;
    }
}
