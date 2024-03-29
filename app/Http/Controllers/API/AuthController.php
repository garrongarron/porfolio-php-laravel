<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = Hash::make($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'message' => 'Successfully registered',
            'access_token' => $accessToken
        ], 201);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'This User does not exist, check your details'], 400);
        }

        $tokens = auth()->user()->tokens;

        foreach ($tokens as $token) {
            $token->revoke();
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            // 'user' => auth()->user(),
            'message' => 'Successfully logged in',
            'access_token' => $accessToken,
            
        ]);
    }

    public function logout(Request $request)
    {
        // $request->user()->token()->revoke();//just one

        $tokens = $request->user()->tokens; //all of them

        foreach ($tokens as $token) {
            $token->revoke();
        }

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
