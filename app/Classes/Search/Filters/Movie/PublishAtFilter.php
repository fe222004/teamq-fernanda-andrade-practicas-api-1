<?php

namespace App\Classes\Search\Filters\Movie;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PublishAtFilter
{
    public static function apply (Builder $query,Request $request)
    {

        if($request->publish_at){

            $query->where('publish_at','like','%'.$request->publish_at.'%');
        }
        return $query;
    }

}
