<?php

namespace App\Http\Controllers;

use App\Models\Users\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class RankController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('search')) {
            $users = User::whereLike(['steam_name', 'nickname', 'steamid'], request()->search)->get();
        } else {
            $users = User::all();
        }
        $users = $users->sortBy('rank');
        return $this->showAll($users, 'globalUserTransformer');
    }
}
