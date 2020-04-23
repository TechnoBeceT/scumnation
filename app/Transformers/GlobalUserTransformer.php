<?php

namespace App\Transformers;

use App\Models\Logs\Kill;
use App\Models\Users\User;
use League\Fractal\TransformerAbstract;

class GlobalUserTransformer extends TransformerAbstract
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
        $kills = Kill::where('killer_id', $user->id)->orWhere('victim_id', $user->id)->orderBy('date', 'desc')->limit(20)->get();
        return [
            'isAdmin'           => (bool)false,
            'characterName'     => (string)$user->nickname,
            'steamName'         => (string)$user->steam_name,
            'avatar'            => (string)$user->avatar,
            'steamID'           => (string)$user->steamid,
            'steamURL'          => (string)$user->profile_url,
            'lastLogin'         => (string)$user->statistics->last_login,
            'lastLogout'        => (string)$user->statistics->last_logout,
            'totalDeaths'       => (integer)$user->statistics->total_deads,
            'totalKills'        => (integer)$user->statistics->total_kills,
            'killDeathRatio'    => (integer)$user->statistics->kd,
            'bounty'            => (integer)$user->bounty->amount,
            'rank'              => (int)$user->rank,
            'user_type'         => (string)$user->subscription ? $user->subscription->plan->tier : 'regular',
            'kills'             => fractal($kills, new KillTransformer),
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
            'steamURL'          => 'profile_url',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
