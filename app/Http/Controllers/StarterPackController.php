<?php

namespace App\Http\Controllers;

use App\Models\Trading\Pack;
use App\Traits\ApiResponser;

class StarterPackController extends Controller
{
    use ApiResponser;

    /**
    * Create a new PostController instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if($user->starter_kit == True){
            return $this->errorResponse(__('messages.alreadyClaimed'), 400);
        }
        try {
            $starterPack = Pack::find(17);
            foreach ($starterPack->contents as $packItem) {
                $user->addItem($packItem->item_id, $packItem->amount);
            }
            $user->starter_kit = True;
            $user->save();
            return $this->successResponse(['message' => __('messages.claimSuccess')], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse(__('messages.claimFailed'), 200);
        }
    }
}
