<?php

namespace App\Transformers;

use App\Models\Trading\PackContent;
use League\Fractal\TransformerAbstract;

class PackContentTrasformer extends TransformerAbstract
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
    public function transform(PackContent $packContent)
    {
        return [
            'item_name'     => (string)$packContent->item->item_name,
            'item_image'    => (string)$packContent->item->item_image,
            'amount'        => (string)$packContent->amount,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'item_name'     => 'item.item_name',
            'amount'         => 'amount',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
