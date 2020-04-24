<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\Users\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponser;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->showOne($user, 'globalUserTransformer');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $loggedInUser = auth()->user();
        if($user->id != $loggedInUser->id) {
            return $this->errorResponse(__('messages.incorrectUser'), 400);
        }
        try {
            $user->update([
                'name'      => $request->name,
                'surname'   => $request->surname,
                'email'     => $request->email
            ]);
            return $this->returnLoggedInUser($user);
        } catch (\Throwable $th) {
            return $this->errorResponse(__('messages.wentWrongUpdateUser'), 400);
        }
        

    }
}
