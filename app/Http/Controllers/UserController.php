<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\QueryParam;

class UserController extends Controller
{
    #[Group("User management")]
    #[QueryParam("per_page", "int")]
    #[QueryParam("page", "int")]
    #[Authenticated]
    public function index()
    {
        return  UserResource::collection(
            User::query()->paginate(
                perPage: \request('perPage'),
                page: \request('page')
            )
        );
    }

    #[Group("User management")]
    #[Authenticated]
    public function show(User $user)
    {
        return response()->json($user);
    }

}
