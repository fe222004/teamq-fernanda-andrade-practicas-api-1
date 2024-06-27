<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentRequest;
use App\Http\Resources\RentResource;
use App\Models\Rent;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\QueryParam;
use Symfony\Component\HttpFoundation\Response;

class RentController extends Controller
{
    #[Group("Rent management")]
    #[QueryParam("per_page", "int")]
    #[QueryParam("page", "int")]
    #[Authenticated]
    public function index()
    {
        return  RentResource::collection(
            Rent::query()->paginate(
                perPage: \request('perPage'),
                page: \request('page')
            )
        );
    }

    #[Group("Rent management")]
    #[Authenticated]
    public function store(RentRequest $request)
    {
        $rent = Rent::query()->create($request->validated());
        return new RentResource($rent);
    }

    #[Group("Rent management")]
    #[Authenticated]
    public function show(Rent $rent)
    {
        return response()->json($rent);
    }


    #[Group("Rent management")]
    #[Authenticated]
    public function update(RentRequest $request, Rent $rent)
    {
        $rent->fill($request->validated());
        $rent->save();
        return new RentResource($rent);
    }

    #[Group("Rent management")]
    #[Authenticated]
    public function destroy(Rent $rent)
    {
        $rent->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
