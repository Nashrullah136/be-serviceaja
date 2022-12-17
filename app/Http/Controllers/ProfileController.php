<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function UpdateProfile(ProfileRequest $request)
    {
        $user = $request->user();
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->save();
        return new UserResource($user);
    }

    public function ChangePassword(PasswordRequest $request)
    {
        $user = $request->user();
        if (!Hash::check($request->old_password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return ["message" => "Success"];
    }
}
