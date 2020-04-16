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
                    'id'                => (int)$history->id,
                    'type'              => (string)$history->action_type,
                    'amount'            => (float)$history->amount,
                    'description'       => (string)__('messages.playTimeCredit')
                ];
            case History::KILL:
                return [
                    'id'                => (int)$history->id,
                    'type'              => (string)$history->action_type,
                    'amount'            => (float)$history->amount,
                    'description'       => (string) __('messages.killCredit', ['value' => $history->victim->nickname])
                ];
            case History::DEATH:
                return [
                    'id'                => (int)$history->id,
                    'type'              => (string)$history->action_type,
                    'amount'            => (float)$history->amount,
                    'description'       => (string)__('messages.creditDeath', ['value' => $history->killer->nickname])
                ];
            case History::BOUNTY:
                return [
                    'id'                => (int)$history->id,
                    'type'              => (string)$history->action_type,
                    'amount'            => (float)$history->amount,
                    'description'       => (string)$history->action_type === History::DEDUCT ? __('messages.creditBountySet', ['value' => $history->victim->nickname]) : __('messages.creditBountyEarn', ['value' => $history->victim->nickname])
                ];
        }
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id'                => 'id',
            'type'              => 'action_type',
            'amount'            => 'amount'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
