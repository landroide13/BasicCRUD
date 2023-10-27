<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        
        $fields = $request -> validate([
            'email' => ['required', 'email'],
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password) ){
            return response([
                'Message' => 'Wrong Creds.'
            ], 401);
        }

        $token = $user -> createToken('userToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function signup(Request $request){

        $fields = $request -> validate([
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|string|confirmed',
        ]);

        $fields['password'] = bcrypt($fields['password']);

        $newUser = User::create($fields);

        $token = $newUser -> createToken('userToken')->plainTextToken;

        $response = [
            'user' => $newUser,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request){

        /** @var User $user*/
        $user = $request -> user();

        $user -> currentAccessToken()->delete();

        return response('', 204);
    }
}
