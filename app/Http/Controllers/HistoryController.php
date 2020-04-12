<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class HistoryController extends Controller
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
        return $this->showAll($user->history);
    }
}
