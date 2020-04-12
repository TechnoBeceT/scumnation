<?php

namespace App\Transformers;

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
            'name'              => (string)$user->name,
            'surname'           => (string)$user->surname,
            'email'             => (string)$user->email,
            'credits'           => (integer)$user->credit->amount,
            'lastLogin'         => (string)$user->statistics->last_login,
            'lastLogout'        => (string)$user->statistics->last_logout,
            'totalDeaths'       => (integer)$user->statistics->total_deads,
            'totalKills'        => (integer)$user->statistics->total_kills,
            'killDeathRatio'    => (float)$user->statistics->kd,
            'eloStat'           => (float)$user->statistics->elo
        ];
    }
}
