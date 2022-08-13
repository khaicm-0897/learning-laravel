<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return define response
     */
    public function index()
    {
        $users = $this->userRepository->getAll();

        return response()->json($users);
    }

    /**
     * Display the specified resource.
     *
     * int  $id
     * @return define response
     */
    public function show($id)
    {
        try {
            $user = $this->userRepository->find($id);

            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * int  $id
     * @return define response
     */
    public function edit($id)
    {
        try {
            $user = $this->userRepository->find($id);

            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * UpdateUserRequest  $request
     * int  $id
     * @return define response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = $this->userRepository->find($id);

            if (Storage::exists('avatars/' . $user->avatar)) {
                Storage::delete('avatars/' . $user->avatar);

                $extension = $request->avatar->getClientOriginalExtension();
                $newNameAvatar = time() . '.' . $extension;
                Storage::putFileAs(
                    'avatars',
                    $request->file('avatar'),
                    $newNameAvatar
                );
            }
            $this->userRepository->update($id, [
                'name' => $request->name,
                'avatar' => $newNameAvatar,
            ]);

            return response()->json([
                'message' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * int  $id
     * @return define response
     */
    public function destroy($id)
    {
        try {
            $user = $this->userRepository->find($id);

            if (Storage::exists('avatars/' . $user->avatar)) {
                Storage::delete('avatars/' . $user->avatar);
                $user = $this->userRepository->delete($id);
            }

            return response()->json([
                'message' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
            ]);
        }
    }
}
