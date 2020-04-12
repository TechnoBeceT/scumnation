<?php

namespace App\Http\Controllers;

use App\Models\Logs\Kill;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class KillController extends Controller
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
        $kills = Kill::where('killer_id', auth()->user()->id)->orWhere('victim_id', auth()->user()->id)->get();
        return $this->showAll($kills);
    }
}
