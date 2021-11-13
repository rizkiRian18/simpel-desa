<?php

namespace App\Http\Controllers;

use App\Admin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AdminResource;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller


{

    use AuthenticatesUsers;
    public function __construct()
    {
        // Auth::shouldUse('admin');
    }

    public function getLogin()
    {
        return view('auth.adminlogin');
    }





    public function postLogout()
    {
        auth()->guard('admin')->logout();
        session()->flush();

        return redirect()->route('admin.login');
    }

    public function adminregister(AdminRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),208);
        }

        $admin = Admin::create([
            'email' => $request->email,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
        ]);

        Config::set('jwt.user', 'App\Admin');
        Config::set('auth.providers.users.model', App\Admin::class);
        $credentials = $request->only('email', 'nama', 'password');
        $token = auth()->attempt($credentials);

        return (new AdminResource($request->user()))
                ->additional(['meta' =>
                 [
                    'token' => $token,
                ]]);
    }


}
