<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceBountyRequest;
use App\Models\Finance\History;
use App\Models\Users\User;
use App\Traits\Controllers\BountyControllerHelper;

class BountyController extends Controller
{
    use BountyControllerHelper;

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
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PlaceBountyRequest  $request
     * @param  App\Models\Users\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceBountyRequest $request, User $user)
    {
        $loggedInUser = auth()->user();
        $this->validateBountyRequest($request, $user, $loggedInUser);
        try {
            $user->addBounty($request->bounty);
            $loggedInUser->deductCredits($request->bounty);
            History::create([
                'user_id'       => $loggedInUser->id,
                'type'          => History::BOUNTY,
                'victim_id'     => $user->id,
                'action_type'   => History::DEDUCT,
                'amount'        => $request->bounty
            ]);
            return $this->successResponse(['message' => __('messages.bountySetSuccessfully', ['value' => $user->nickname]), 'credits' => $loggedInUser->credit->amount], 200);
        } catch (\Throwable $th) {
            return $this->errorResponse(__('messages.bountySetFailed'), 401);
        }
        
    }
}
