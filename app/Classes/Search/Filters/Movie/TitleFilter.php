<?php

namespace App\Classes\Search\Filters\Movie;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TitleFilter
{
    public static function apply (Builder $query,Request $request)
    {

        if($request->title){

            $query->where('title','like','%'.$request->title.'%');
        }
        return $query;
    }

}
