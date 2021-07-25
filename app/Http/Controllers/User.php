<?php

namespace App\Http\Controllers;


use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User as users;
use Firebase\JWT\JWT;

class User extends Controller
{

    protected $jwt;

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        $token =  JWT::encode($credentials, env('JWT_SECRET'));
        
        $data = [
            'token' => $token
        ];
        return response()->json($data);
    }

    public function test(Request $request)
    {
        $token = $request->header('Authorization');
        echo $token;
    }
}
