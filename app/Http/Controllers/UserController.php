<?php

namespace App\Http\Controllers;

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
    public function update(Request $request, User $user)
    {
        //
    }
}
