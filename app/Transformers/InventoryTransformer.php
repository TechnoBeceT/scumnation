<?php

namespace App\Transformers;

use App\Models\Trading\Inventory;
use League\Fractal\TransformerAbstract;

class InventoryTransformer extends TransformerAbstract
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
    public function transform(Inventory $inventory)
    {
        return [
            'item_id'       => $inventory->item_id,
            'item_name'     => $inventory->item->item_name,
            'item_image'    => $inventory->item->item_image,
            'amount'        => $inventory->amount
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'item_id'     => 'item_id',
            'amount'         => 'amount',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
