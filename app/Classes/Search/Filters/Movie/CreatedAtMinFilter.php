<?php

namespace App\Classes\Search\Filters\Movie;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CreatedAtMinFilter
{
    public static function apply (Builder $query,Request $request)
    {

        if($request->min_created_at){

            $query->where('created_at','like','%'.$request->min_created_at.'%');
        }

        return $query;
    }

}
