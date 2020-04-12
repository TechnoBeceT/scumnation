<?php

namespace App\Http\Controllers;

use App\Models\Logs\Kill;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class KillFeedController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(Kill::all());
    }
}
