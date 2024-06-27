<?php

namespace App\Classes\Search\Filters\Movie;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ActorFilter
{
    public static function apply (Builder $query,Request $request)
    {

        if($request->actors){
            $query->whereHas('actors',function ($q)use ($request){
                $q->whereIn('actors.id',$request->actors);
            });
        }

        return $query;
    }

}
