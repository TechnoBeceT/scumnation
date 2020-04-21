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
        switch ($sale->content_type) {
            case Sale::ITEM:
                return [
                    'id'    => $sale->id,
                    'name'  => $sale->realItem->item_name,
                    'price' => $sale->price,
                    'image' => $sale->realItem->item_image,
                    'content_type' => $sale->content_type,
                    'categorytype' => $sale->realItem->category->categoryType->type_name,
                    'categoryname' => $sale->realItem->category->category_name,
                ];
            case Sale::PACK:
                return [
                    'id'    => $sale->id,
                    'name'  => $sale->realPack->pack_name,
                    'price' => $sale->price,
                    'image' => $sale->realPack->pack_image,
                    'content_type' => $sale->content_type,
                    'categorytype' => $sale->realPack->category->categoryType->type_name,
                    'categoryname' => $sale->realPack->category->category_name,
                    'contents'     => fractal($sale->realPack->contents, new PackContentTrasformer)
                ];
        }
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'id'        => 'id',
            'price'     => 'price',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
