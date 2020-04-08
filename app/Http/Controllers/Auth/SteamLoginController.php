<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use kanalumaddela\LaravelSteamLogin\Http\Controllers\AbstractSteamLoginController;
use kanalumaddela\LaravelSteamLogin\SteamUser;

class SteamLoginController extends AbstractSteamLoginController
{

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function authenticate()
    {
        if ($this->steam->validated()) {
            $result = $this->authenticated($this->request, $this->steam->getPlayer());

            if (!empty($result)) {
                return $result;
            }
        } else {
            throw new Exception('Steam Login failed. Response: '.$this->steam->getOpenIdResponse());
        }

        return $this->steam->previousPage();
    }


    public function authenticated(Request $request, SteamUser $steamUser)
    {
        // find user by their steam account id, example assumes `steam_account_id` on `users` table
        $user = User::where('steamid', $steamUser->steamId)->first();

        // if the user doesn't exist, create them
        if (!$user) {
            return response()->json("First login our server please", 200);
        }else {
            $steamUser->getUserInfo(); // retrieve and set user info pulled from steam
            $user->avatar = $steamUser->avatarFull;
            $user->nickname = $steamUser->steam_name;
            $user->save();
        }

        

        // login the user using the Auth facade
        Auth::login($user, true);
    }

    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }
}