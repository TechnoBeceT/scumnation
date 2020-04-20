<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json(array_merge($data, ['code' => $code]), $code);
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

    protected function showAll(Collection $collection, $transformer = 'default', $code = 200)
    {
        if ($collection->isEmpty()) {
            return $this->successResponse($collection, $code);
        }
        
        switch ($transformer) {
            case 'globalUserTransformer':
                $transformer = $collection->first()->globalUserTransformer;
                break;
            default:
                $transformer = $collection->first()->transformer;
                break;
        }
        $collection = $this->filterData($collection, $transformer);
        $collection = $this->sortData($collection, $transformer);
        $collection = $this->paginate($collection);
        $collection = $this->transformData($collection, $transformer);

        return $this->successResponse($collection, $code);
    }

    protected function showOne(Model $instance, $transformer = 'default', $code = 200)
    {
        switch ($transformer) {
            case 'globalUserTransformer':
                $transformer = $instance->globalUserTransformer;
                break;
            default:
                $transformer = $instance->transformer;
                break;
        }
        $instance = $this->transformData($instance, $transformer);
        return $this->successResponse($instance, $code);
    }

    protected function filterData(Collection $collection, $transformer)
    {
        foreach(request()->query() as $query => $value) {
            $attribute = $transformer::originalAttribute($query);

            if(isset($attribute, $value)) {
                $collection = $collection->where($attribute, $value);
            } 
        }

        return $collection;
    }

    protected function sortData(Collection $collection, $transformer)
    {
        if (request()->has('sort_by_desc')) {
            $attribute = $transformer::originalAttribute(request()->sort_by_desc);

            $collection = $collection->sortByDesc->{$attribute};
        }

        if (request()->has('sort_by_asc')) {
            $attribute = $transformer::originalAttribute(request()->sort_by_asc);

            $collection = $collection->sortBy->{$attribute};
        }
        return $collection;
    }

    protected function paginate(Collection $collection)
    {
        $rules = [
            'per_page' => 'integer|min:2|max:200',
        ];

        Validator::validate(request()->all(), $rules);

        $page = LengthAwarePaginator::resolveCurrentPage();

        $perPage = 15;
        if (request()->has('per_page')) {
            $perPage = (int)request()->per_page;
        }

        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $paginated->appends(request()->all());

        return $paginated;
    }


    protected function transformData($data, $transformer)
    {
        $transformation = fractal($data, new $transformer);

        return $transformation->toArray();
    }
}
