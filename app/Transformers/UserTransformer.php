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
        $isAdmin = false;
        if($user->steamid == '76561198009780481' || $user->steamid == '76561198123650511') {
            $isAdmin = true;
        }
        return [
            'isAdmin'           => (bool)$isAdmin,
            'characterName'     => (string)$user->nickname,
            'steamName'         => (string)$user->steam_name,
            'avatar'            => (string)$user->avatar,
            'steamID'           => (string)$user->steamid,
            'steamURL'          => (string)$user->profile_url,
            'name'              => (string)$user->name,
            'surname'           => (string)$user->surname,
            'email'             => (string)$user->email,
            'credits'           => (integer)$user->credit->amount,
            'lastLogin'         => (string)$user->statistics->last_login,
            'lastLogout'        => (string)$user->statistics->last_logout,
            'totalDeaths'       => (integer)$user->statistics->total_deads,
            'totalKills'        => (integer)$user->statistics->total_kills,
            'killDeathRatio'    => (integer)$user->statistics->kd,
            'bounty'            => (integer)$user->bounty->amount,
            'rank'              => (int)$user->rank,
            'user_type'         => (string)$user->subscription ? $user->subscription->plan->tier : 'regular',
            'hasClaimSTK'       => (bool)$user->starter_kit
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
            'hasClaimSTK'       => 'starter_kit'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
