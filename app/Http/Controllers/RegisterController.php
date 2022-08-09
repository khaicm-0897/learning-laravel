<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $type = $request->avatar->getClientOriginalExtension();
            $newNameAvatar = time() . '.' . $type;
            $request->file('avatar')->move(public_path('/image'), $newNameAvatar);

            return User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'avatar' => $newNameAvatar,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'error',
            ], 400);
        }
    }
}
