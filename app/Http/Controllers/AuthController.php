<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Subgroup;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    #[Group("Security management")]
    #[SubGroup("Auth")]
    public function login(AuthRequest $request){
        if(!Auth::attempt($request->only('email','password'))){

            return response()->json(['msg'=>'clave incorrecta'], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email',$request['email'])->firstOrFail();
        $token = $user->createToken('authToken')->plainTextToken;

        return \response()
            ->json([
                'message'=>'Hi ',$user->name,
                'accessToken'=>$token,
                'token_type'=>'Bearer',
                'user'=>$user
            ]);

    }

    #[Group("Security management")]
    #[SubGroup("Auth")]
    public function register(UserRequest $request)
    {
        $user = User::query()->create($request->validated());
      //  return new UserResource($user);
        $token = $user->createToken('authToken')->plainTextToken;
        return response()
            ->json(['data'=>$user,'access_token'=>$token,'Bearer',]);
    }
    #[Group("User management")]
    #[SubGroup("Auth")]
    public function user()
    {
        $user= User::all();
        return response()->json($user);
    }

    #[SubGroup("Auth")]
    public function users(): \Illuminate\Http\JsonResponse
    {
        $user= User::all();
        return response()->json($user);
    }

    #[Group("User management")]
    #[SubGroup("User")]
    #[Authenticated]
    public function update(UserRequest $request,User $user)
    {
        $user->fill($request->validated());
        $user->save();
        return new AuthResource($user);
    }


    #[Group("User management")]
    #[SubGroup("User")]
    #[Authenticated]
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
