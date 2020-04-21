<?php

namespace App\Transformers;

use App\Models\Trading\Sale;
use League\Fractal\TransformerAbstract;

class SaleTransformer extends TransformerAbstract
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
    public function transform(Sale $sale)
    {
        return [
            'id'    => $sale->item_id,
            'name'  => $sale->realItem->item_name,
            'price' => $sale->price,
            'image' => $sale->realItem->item_image,
            'categorytype' => $sale->realItem->category->categoryType->type_name,
            'categoryname' => $sale->realItem->category->category_name,
        ];
    }
}
