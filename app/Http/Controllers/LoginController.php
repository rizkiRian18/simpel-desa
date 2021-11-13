<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\Register as RegisterResource;


class LoginController extends Controller
{
    public function loginn(LoginRequest $request)
    {
        $credentials = $request->only('nik', 'password');
        
        try {
            if (!$token = auth()->attempt($credentials)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid_Credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'status' =>false,
                'message' => "could not create token"
            ], 500);
        }

    
        return response()->json([
                'status' => true,
                'response' => Auth::user(),
                'token' => $token,
                'message' => "user login success"
           ], 200);
    }
}
