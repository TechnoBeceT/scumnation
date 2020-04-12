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
            'id'        => (int)md5($kill->id),
            'kill'      => (bool)auth()->check() && auth()->user()->id == $kill->killer_id ? True : False,
            'killer'    => (string)$kill->killer->nickname,
            'killerX'   => (string)$kill->killerX,
            'killerY'   => (string)$kill->killerY,
            'victim'    => (string)$kill->victim->nickname,
            'victimX'   => (string)$kill->victimX,
            'victimY'   => (string)$kill->victimY,
            'type'      => (string)$kill->type,
            'date'      => (string)$kill->date
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'killer'    => 'killer.nickname',
            'killerX'   => 'killerX',
            'killerY'   => 'killerY',
            'victim'    => 'victim.nickname',
            'victimX'   => 'victimX',
            'victimY'   => 'victimY',
            'type'      => 'type',
            'date'      => 'date'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
