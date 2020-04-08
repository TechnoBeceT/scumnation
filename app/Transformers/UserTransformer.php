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
            'characterName'     => (string)$user->nickname,
            'steamName'         => (string)$user->steam_name,
            'avatar'            => (string)$user->avatar,
            'name'              => (string)$user->name,
            'surname'           => (string)$user->surname,
            'email'             => (string)$user->email,
            'credits'           => $user->credit->amount,
            'lastLogin'         => $user->statistics->last_login,
            'lastLogout'        => $user->statistics->last_logout,
            'totalDeads'        => $user->statistics->total_deads,
            'totalKills'        => $user->statistics->total_kills,
            'killDeathRatio'    => $user->statistics->kd,
            'eloStat'           => $user->statistics->elo
        ];
    }
}
