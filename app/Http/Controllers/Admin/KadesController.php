<?php

namespace App\Http\Controllers\Admin;

use App\Rw;
use App\Kades;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests\RwRequest;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;


class KadesController extends Controller
{



    public function __construct()
    {
       Auth::shouldUse('kades');
    }

    // public function index(Request $request){

    //     $kades = Kades::paginate(10);

    //     return view('kades.index', ['kades' => $kades]);
    // }

    public function index(Request $request){
        $kades = Kades::all();


        if ($request->ajax()) {
            $user = Kades::all();

            return DataTables::of($user)
            ->toJson();
        }
        return view('admin.kades-index', ['kades' => $kades]);
    }

    public function edit(Request $request){
        Kades::where('id', $request->input('id'))
        ->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'password' => bcrypt($request->password)


        ]);

        return redirect('/kades')->with('true', 'Data Berhasil di Ubah');

    }

    public function delete(Request $request)
    {
        Kades::where('id',$request->input('id'))
        ->delete();

        return redirect('/kades')->with('true', 'Data berhasil di hapus');
    }

    // public function show(Kades $kades){
    //     return view('rw.details', compact('kades'));
    // }


    public function register(Request $request){


        $validator = Validator::make($request->all(), [
            'nik'=> 'required|unique:kades|max:16|min:16',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/kades')->with('error', 'Data Gagal Di Simpan');
        }else{
            $user = Kades::create([
                'nama' => $request->nama,
                'nik' =>  $request->nik,
                'password' => bcrypt($request->password),
            ]);

            Config::set('jwt.user', 'App\Kades');
            Config::set('auth.providers.users.model', App\Kades::class);
            $credentials = $request->only('nama', 'nik', 'password');
            $token = auth()->attempt($credentials);
            // return redirect('/kades')->with('status', 'Data Berhasil di Simpan');

        //     return response()->json([
        //         'status' => true,
        //         'response' => Auth::user(),
        //         'token' => $token,
        //         'message' => "user login success"
        //    ], 200);

        return redirect('/kades')->with('true', 'Data Kades Berhasil di Tambah');
        }


    }

    // public function edit(Rw $rw){
    //     return view('rw.edit', compact('rw'));
    // }

    // public function update(Request $request, Rw $rw){


    //     Rw::where('id', $rw->id)

    //                 ->update([
    //                     'nama' => $request->nama,
    //                     'nik' => $request->nik,
    //                     'password' => bcrypt($request->password)
    //                 ]);
    //     return redirect('/rw')->with('status', 'Data Berhasil di Ubah');
    // }
}
