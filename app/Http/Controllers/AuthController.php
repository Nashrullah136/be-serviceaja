<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = Hash::make($request->password);
        $user->role = User::USER;
        $user->save();
        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function logout(Request $request){
        $tokenId = $request->user()->currentAccessToken()->id;
        $request->user()->tokens()->where('id', $tokenId)->delete();
    }

    public function user(Request $request){
        return new UserResource($request->user());
    }
}
