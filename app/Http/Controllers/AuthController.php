<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // register
    public function register(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|unique:tm_user,user_id',
            'user_nama' => 'required|string',
            'user_pass' => 'required|string|min:6',
            'user_hak' => 'required|string',
            'user_sts' => 'required|string',
        ]);

        $user = User::create([
            'user_id' => $request->user_id,
            'user_nama' => $request->user_nama,
            'user_pass' => Hash::make($request->user_pass),
            'user_hak' => $request->user_hak,
            'user_sts' => $request->user_sts,
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    // login
    public function login(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'user_pass' => 'required|string',
        ]);

        $user = User::where('user_id', $request->user_id)->first();

        if (!$user || !Hash::check($request->user_pass, $user->user_pass)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    // logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
