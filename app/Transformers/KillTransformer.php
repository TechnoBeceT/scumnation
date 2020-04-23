<?php

namespace App\Transformers;

use App\Models\Logs\Kill;
use League\Fractal\TransformerAbstract;

class KillTransformer extends TransformerAbstract
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
    public function transform(Kill $kill)
    {
        return [
            'id'            => (string)md5($kill->id),
            'isKill'        => (bool)auth()->check() && auth()->user()->id == $kill->killer_id ? True : False,
            'killer'        => (string)$kill->killer->nickname,
            'killerSteamID' => (string)$kill->killer->steamid,
            'killerAvatar'  => (string)$kill->killer->avatar,
            'killerSteam'   => (string)$kill->killer->profile_url,
            'killerstName'  => (string)$kill->killer->steam_name,
            'killerX'       => (string)$kill->killerX,
            'killerY'       => (string)$kill->killerY,
            'victim'        => (string)$kill->victim->nickname,
            'victimAvatar'  => (string)$kill->victim->avatar,
            'victimSteamID' => (string)$kill->victim->steamid,
            'victimSteam'   => (string)$kill->victim->profile_url,
            'victimstName'  => (string)$kill->victim->steam_name,
            'victimX'       => (string)$kill->victimX,
            'victimY'       => (string)$kill->victimY,
            'sector'        => (string)$kill->sector,
            'distance'      => (string)$kill->distance,
            'type'          => (string)$kill->type,
            'date'          => (string)$kill->date
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'killer'        => 'killer.nickname',
            'killerAvatar'  => 'killer.avatar',
            'killerX'       => 'killerX',
            'killerY'       => 'killerY',
            'victim'        => 'victim.nickname',
            'victimAvatar'  => 'victim.avatar',
            'victimX'       => 'victimX',
            'victimY'       => 'victimY',
            'type'          => 'type',
            'date'          => 'date'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
