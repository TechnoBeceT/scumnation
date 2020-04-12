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
            'killer'    => $kill->killer->nickname,
            'killerX'   => $kill->killerX,
            'killerY'   => $kill->killerY,
            'victim'    => $kill->victim->nickname,
            'victimX'   => $kill->victimX,
            'victimY'   => $kill->victimY,
            'type'      => $kill->type,
            'date'      => $kill->date
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
