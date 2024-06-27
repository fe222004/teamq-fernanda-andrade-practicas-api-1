<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use App\Models\Movie;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\Subgroup;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    #[Group("Images management")]
    #[QueryParam("per_page", "int")]
    #[QueryParam("page", "int")]
    #[Authenticated]

    public function index(Movie $movie): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return  ImageResource::collection(
            $movie->images()->paginate(
                perPage: \request('perPage'),
                page: \request('page')
            )
        );
    }

    #[Group("Images management")]
    #[Authenticated]

    public function store(ImageRequest $request, Movie $movie)
    {
        $image=new Image($request->validated());
        return new ImageResource($movie->images()->save($image));

    }

    #[Group("Images management")]
    #[Authenticated]
    public function show(Movie $movie,Image $image)
    {
        abort_if($movie->id!==$image->movie_id,Response::HTTP_NOT_FOUND);//validamos si se esta pasando una imagen que no este asociada a la pelicula
        return new ImageResource($image);
    }

    #[Group("Images management")]
    #[Authenticated]

    public function update(Movie $movie,Image $image,ImageRequest $request,)
    {
        abort_if($movie->id!==$image->movie_id,Response::HTTP_NOT_FOUND);
        $image->fill($request->validated());
        $image->save();
        return new ImageResource($image);
    }

    #[Group("Images management")]
    #[Authenticated]
    public function destroy(Image $image,Movie $movie)
    {
        abort_if($movie->id!==$image->movie_id,Response::HTTP_NOT_FOUND);
        $image->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
