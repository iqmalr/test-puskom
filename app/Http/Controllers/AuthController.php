<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest  $request)
    {
        $fields = $request->validated();
        $user = User::create($fields);
        $token = $user->createToken($request->name);
        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }
    public function login(LoginUserRequest  $request)
    {
        // Validasi dilakukan otomatis oleh LoginUserRequest

        // Mengambil data yang telah divalidasi
        $credentials = $request->validated();

        // Mencari user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        // Periksa password
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'The provided credentials are incorrect.'], 401);
        }

        // Membuat token untuk user
        $token = $user->createToken('auth_token');

        // Mengembalikan user beserta tokennya
        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
