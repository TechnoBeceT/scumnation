<?php

namespace App\Transformers;

use App\Models\Finance\History;
use League\Fractal\TransformerAbstract;

class HistoryTransformer extends TransformerAbstract
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
    public function transform(History $history)
    {
        switch ($history->type) {
            case History::PLAYTIME:
                return [
                    'type'              => $history->action_type,
                    'amount'            => $history->amount,
                    'description'       => 'Credit for playing time'
                ];
            case History::KILL:
                return [
                    'type'              => $history->action_type,
                    'amount'            => $history->amount,
                    'description'       => 'Credit for killing ' . $history->victim->nickname
                ];
            case History::DEATH:
                return [
                    'type'              => $history->action_type,
                    'amount'            => $history->amount,
                    'description'       => 'Credit removed for death. Killer: ' . $history->killer->nickname
                ];
        }
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'type'              => 'action_type',
            'amount'            => 'amount'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
