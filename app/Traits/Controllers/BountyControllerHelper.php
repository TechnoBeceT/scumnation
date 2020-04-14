<?php

namespace App\Traits\Controllers;

use App\Http\Requests\PlaceBountyRequest;
use App\Models\Users\User;
use App\Traits\ApiResponser;

trait BountyControllerHelper
{
    use ApiResponser;

    private function validateBountyRequest(PlaceBountyRequest $request, User $user, User $loggedInUser)
    {
        if($user->id == $loggedInUser->id) {
            abort(401, __('messages.cantSetBountyYourself'));
        }
        if($loggedInUser->credit->amount < $request->bounty) {
            abort(401, __('messages.notEnoughTokens'));
        }
    }
}
