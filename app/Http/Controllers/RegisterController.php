<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Exception;

class RegisterController extends Controller
{
    protected $userRepository;

    /**
     * UserController construct
     * 
     * UserRepositoryInterface $userRepository
     * @return void
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Register user
     * 
     * RegisterRequest $request
     * @return stdClass
     */
    public function register(RegisterRequest $request)
    {
        try {
            $extension = $request->avatar->getClientOriginalExtension();
            $newNameAvatar = time() . '.' . $extension;
            Storage::putFileAs(
                'avatars',
                $request->file('avatar'),
                $newNameAvatar
            );

            return $this->userRepository->create([
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
