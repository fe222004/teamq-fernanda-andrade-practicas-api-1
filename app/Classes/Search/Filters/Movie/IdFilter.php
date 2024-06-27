<?php

namespace App\Classes\Search\Filters\Movie;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class IdFilter
{
    public static function apply (Builder $query,Request $request)
    {

        if($request->id){

            $query->where('id',$request->id);
        }
        return $query;
    }

}
