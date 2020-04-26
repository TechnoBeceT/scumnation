<?php

namespace App\Http\Controllers\Auth;

use App\Models\Users\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use kanalumaddela\LaravelSteamLogin\Http\Controllers\AbstractSteamLoginController;
use kanalumaddela\LaravelSteamLogin\SteamUser;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Cookie;

class SteamLoginController extends AbstractSteamLoginController
{
    use ApiResponser;


    public function authenticated(Request $request, SteamUser $steamUser)
    {
        // find user by their steam account id, example assumes `steam_account_id` on `users` table
        $user = User::where('steamid', $steamUser->steamId)->first();

        // if the user doesn't exist, create them
        if (!$user) {
            //return $this->successResponse(['isLoggedIn' => false, 'message' => __('messages.userNotFound')], 200);
            $data = ['isLoggedIn' => false, 'message' => __('messages.userNotFound')];
            return response()->view('login', compact('data'), 200)
                    ->header("Refresh", "5;url=https://scumnation.eu");
        }else {
            $steamUser->getUserInfo(); // retrieve and set user info pulled from steam
            $user->avatar = $steamUser->avatarFull;
            $user->steam_name = $steamUser->name;
            $user->profile_url = $steamUser->profileUrl;
            $user->save();
        }

        // login the user using the Auth facade
        try {
            if (!$token = JWTAuth::fromUser($user)) {
                //return $this->successResponse(['isLoggedIn' => false, 'message' => __('messages.invalidCredentials')], 200);
                $data = ['isLoggedIn' => false, 'message' => __('messages.invalidCredentials')];
                return response()->view('login', compact('data'), 200)
                    ->header("Refresh", "5;url=https://scumnation.eu");
            }
        } catch (JWTException $e) {
            //return $this->successResponse(['isLoggedIn' => false, 'message' => __('messages.notCreateToken')], 200);
            $data = ['isLoggedIn' => false, 'message' => __('messages.notCreateToken')];
            return response()->view('login', compact('data'), 200)
                ->header("Refresh", "5;url=https://scumnation.eu");
        }
        //Create Cookie With Token
        $cookie = Cookie::queue(Cookie::make('token', $token, config('jwt.ttl'), '/', null, true, true));
        //Return Logged In User
        //return $this->returnLoggedInUser($user);
        $data = ['isLoggedIn' => true, 'message' => __('messages.notCreateToken')];
        return response()->view('login', compact('data'), 200)
            ->header("Refresh", "5;url=https://scumnation.eu");
    }

    /**
     * Get the authenticated User.
     *
     * @return App\Traits\ApiResponser\ReturnLoggedInUser
     */
    public function isLoggedIn()
    {
        if (auth()->check()) {
            return $this->returnLoggedInUser(auth()->user());
        } else {
            return $this->successResponse(['isLoggedIn' => false], 200);
        }
    }

    public function loginForPostman()
    {
        // find user by their steam account id, example assumes `steam_account_id` on `users` table
        $user = User::where('id', 1)->first();

        // if the user doesn't exist, create them
        if (!$user) {
            return $this->successResponse(['isLoggedIn' => false, 'message' => __('messages.userNotFound')], 200);
        }

        // login the user using the Auth facade
        try {
            if (!$token = JWTAuth::fromUser($user)) {
                return $this->successResponse(['isLoggedIn' => false, 'message' => __('messages.invalidCredentials')], 200);
            }
        } catch (JWTException $e) {
            return $this->successResponse(['isLoggedIn' => false, 'message' => __('messages.notCreateToken')], 200);
        }
        //Create Cookie With Token
        $cookie = Cookie::queue(Cookie::make('token', $token, config('jwt.ttl'), '/', null, true, true));
        //Return Logged In User
        return $this->returnLoggedInUser($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return App\Traits\ApiResponser\SuccessResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->successResponse(['isLoggedIn' => false, 'message' => __('messages.loggedOut')], 200);
    }
}