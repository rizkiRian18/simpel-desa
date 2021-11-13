<?php

namespace App\Http\Controllers;
use App\Http\Resources\Register as RegisterResource;
use App\User;
use App\Register;
use Illuminate\Http\Request;
use App\Http\Requests\WargaRequest;
use App\Http\Requests\RegisterRequest;


use App\Warga;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Maatwebsite\Excel\Facades\Excel;


use Tymon\JWTAuth\JWTAuth;

class RegisterController extends Controller
{

    public function __construct()
    {
        Auth::shouldUse('warga');
    }

    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik'=> 'required|unique:warga|max:16|min:16',
            'email' => 'required|email',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),208);
        }

        $user = Warga::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'email' =>  $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        Config::set('jwt.user', 'App\Warga'); 
		Config::set('auth.providers.users.model', App\Warga::class);
		$credentials = $request->only('nama', 'nik', 'password');

        $token = auth()->attempt($credentials);
  
        return response()->json([
            'status' => true,
            'response' => Auth::user(),
            'token' => $token,
            'message' => "user login success"
       ], 200);

    }
}
