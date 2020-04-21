<?php

namespace App\Http\Controllers;

use App\Models\Trading\Sale;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Sale::all();
        $transformer = $collection->first()->transformer;
        $collection = $this->transformData($collection, $transformer);
        return $this->successResponse($collection, 200);
    }
}
