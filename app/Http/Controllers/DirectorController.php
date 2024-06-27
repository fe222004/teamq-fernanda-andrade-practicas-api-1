<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorRequest;
use App\Http\Requests\DirectorRequest;
use App\Http\Resources\DirectorResource;
use App\Models\Director;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\QueryParam;
use Symfony\Component\HttpFoundation\Response;

class DirectorController extends Controller
{
    #[Group("Director management")]
    #[QueryParam("per_page", "int")]
    #[QueryParam("page", "int")]
    #[Authenticated]
    public function index()
    {
        $this->authorize('actor-index');
        return  DirectorResource::collection(
            Director::query()->paginate(
                perPage: \request('perPage'),
                page: \request('page')
            )
        );
    }


    #[Group("Director management")]
    #[Authenticated]
    public function store(ActorRequest $request)
    {
        $director = Director::query()->create($request->validated());
        return new DirectorResource($director);
    }

    #[Group("Director management")]
    #[Authenticated]
    public function show(Director $director)
    {
        return response()->json($director);
    }


    #[Group("Director management")]
    #[Authenticated]
    public function update(DirectorRequest $request, Director $director)
    {
        $director->fill($request->validated());
        $director->save();
        return new DirectorResource($director);
    }
    #[Group("Director management")]
    #[Authenticated]
    public function destroy(Director $director)
    {
        $director->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
