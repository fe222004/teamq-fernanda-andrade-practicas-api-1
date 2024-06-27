<?php

namespace App\Classes\Search\Filters\Movie;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DirectorFilter
{
    public static function apply (Builder $query,Request $request)
    {

        if($request->director_id){

            $query->where('director_id',$request->director_id);
        }
        return $query;
    }

}
