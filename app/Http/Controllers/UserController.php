<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Http\Resources\Register as RegisterResource;


class UserController extends Controller
{
    public function user(Request $request)
    {

        try{

            $user = JWTAuth::parseToken()->authenticate();
        }catch ( Exception $e){
            if($e instanceof Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['error' => 'token_invalid'], 400);
            }else{
                return response()->json(['error' => 'token_not_found'], 400);
            }
        }
        return new RegisterResource($user);
        
    }
}
