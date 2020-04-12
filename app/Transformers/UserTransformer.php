<?php

namespace App\Transformers;

use App\Models\Users\Statistic;
use App\Models\Users\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'isAdmin'           => (bool)false,
            'characterName'     => (string)$user->nickname,
            'steamName'         => (string)$user->steam_name,
            'avatar'            => (string)$user->avatar,
            'steamID'           => (string)$user->steamid,
            'name'              => (string)$user->name,
            'surname'           => (string)$user->surname,
            'email'             => (string)$user->email,
            'credits'           => (integer)$user->credit->amount,
            'lastLogin'         => (string)$user->statistics->last_login,
            'lastLogout'        => (string)$user->statistics->last_logout,
            'totalDeaths'       => (integer)$user->statistics->total_deads,
            'totalKills'        => (integer)$user->statistics->total_kills,
            'killDeathRatio'    => $user->statistics->kd,
            'rank'              => (int)$user->rank
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'characterName'     => 'nickname',
            'steamName'         => 'steam_name',
            'avatar'            => 'avatar',
            'name'              => 'name',
            'surname'           => 'surname',
            'email'             => 'email',
            'lastLogin'         => 'statistics.last_login',
            'lastLogout'        => 'statistics.last_logout',
            'totalDeaths'       => 'statistics.total_deads',
            'totalKills'        => 'statistics.total_kills',
            'killDeathRatio'    => 'statistics.kd',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
