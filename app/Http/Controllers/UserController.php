<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // User Register method
    public function register(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users', 'email'],
            'password' => ['required', 'string', 'confirmed']
        ]);

        $user = User::create([
            'name' => $formFields['name'],
            'email' => $formFields['email'],
            'password' => bcrypt($formFields['password'])
        ]);

        // Creating token
        $token = $user->createToken('apptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    // User Login method
    public function login(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        // Checking email
        $user = User::where('email', $formFields['email'])->first();

        // Checking password
        if (!$user || !Hash::check($formFields['password'], $user->password))
        {
            return response([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        // Creating token
        $token = $user->createToken('apptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }


    // User Logout Mehtod
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'User Logged out'
        ];
    }
}
