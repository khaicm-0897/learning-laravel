<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
            ->select('name', 'email', 'avatar')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = DB::table('users')
                ->select('name', 'email', 'avatar')
                ->find($id);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = DB::table('users')->find($id);

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = DB::table('users')->find($id);

            if ($request->avatar == $user->avatar) {
                $newNameAvatar = $request->avatar;
            } else {
                if (Storage::exists('avatars/' . $user->avatar)) {
                    Storage::delete('avatars/' . $user->avatar);

                    $type = $request->avatar->getClientOriginalExtension();
                    $newNameAvatar = time() . '.' . $type;
                    Storage::putFileAs(
                        'avatars',
                        $request->file('avatar'),
                        $newNameAvatar
                    );
                }
            }
            DB::table('users')
                ->where('id', $id)
                ->update([
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = DB::table('users')->find($id);

            if (Storage::exists('avatars/' . $user->avatar)) {
                Storage::delete('avatars/' . $user->avatar);
                DB::table('users')
                    ->where('id', $id)
                    ->delete();
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
