<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login
    public function login(Request $request)
    {
        //step 1 validasi dulu email dan passwordnya
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        //cek email apa ada di database atau tidak
        $user = \App\Models\User::where('email', $loginData['email'])->first();

        //jika email tidak ada
        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        //jika email ada, cek passwordnya
        if (!Hash::check($loginData['password'], $user->password)) {
            return response()->json(['message' => 'Invalid password'], 401);
        }

        //get tokennya dengan user dan password yang ada
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ]);
    }

    //logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful']);
    }
}
