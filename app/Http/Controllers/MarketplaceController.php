<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarketplacePurchaseRequest;
use App\Models\Finance\History;
use App\Models\Trading\Sale;
use App\Traits\Controllers\MarketplaceControllerHelper;

class MarketplaceController extends Controller
{
    use MarketplaceControllerHelper;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Sale::all();
        $transformer = $collection->first()->transformer;
        $collection = $this->transformData($collection, $transformer);
        return $this->successResponse($collection, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarketplacePurchaseRequest $request)
    {
        $user = auth()->user();
        $data = $this->validatePurchaseRequest($request, $user);
        try {
            foreach($request->data as $purchased) {
                $sale = Sale::find($purchased['id']);
                switch ($sale->content_type) {
                    case Sale::ITEM:
                        $user->addItem($sale->item_id, $purchased['quantity']);
                        $user->deductCredits($sale->price);
                        History::create([
                            'user_id'       => $user->id,
                            'type'          => History::SALE,
                            'sale_id'       => $sale->id,
                            'action_type'   => History::DEDUCT,
                            'amount'        => $sale->price
                        ]);
                        break;
                    case Sale::PACK:
                        foreach ($sale->realPack->contents as $packItem) {
                            $user->addItem($packItem->item_id, ($packItem->amount * $purchased['quantity']));
                        }
                        $user->deductCredits($sale->price);
                        History::create([
                            'user_id'       => $user->id,
                            'type'          => History::SALE,
                            'sale_id'       => $sale->id,
                            'action_type'   => History::DEDUCT,
                            'amount'        => $sale->price
                        ]);
                        break;
                }
            }
        } catch (\Throwable $th) {
            return $this->errorResponse(__('messages.purchaseFailed'), 400);
        }
        return $this->successResponse(['messages' => __('messages.successfullyPurchased'), 'credits' => $data['totalPrice']], 200);
    }
}
