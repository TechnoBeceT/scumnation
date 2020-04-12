<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], 200);
    }

    protected function returnLoggedInUser(Model $instance, $code = 200)
    {
        $transformer = $instance->transformer;
        $instance = $this->transformData($instance, $transformer);
        $data = array_merge(['isLoggedIn' => true], $instance);
        return $this->successResponse($data, $code);
    }


    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);

        return $transformation->toArray();
    }
}
