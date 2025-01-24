<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // tampilkan semua user
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        // hash the password
        $data['user_pass'] = Hash::make($data['user_pass']);
        $user = User::create($data);
        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            // $user->update($request->all());
            $data = $request->all();
            if(isset($data['user_pass'])) {
                $data['user_pass'] = Hash::make($data['user_pass']);
            }
            $user->update($data);
            return response()->json($user, 200);
        } else {
            return response()->json(["message" => "User not found"], 404);
        }
    }



    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(["message" => "User not found"], 404);
        }
    }
}
