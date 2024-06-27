<?php

namespace App\Classes\Search\Filters\Movie;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class GenreFilter
{
    public static function apply (Builder $query,Request $request)
    {

        if($request->genre){

            $query->where('genre','like','%'.$request->genre.'%');
        }
        return $query;
    }

}
