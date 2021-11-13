<?php

namespace App\Http\Controllers\Admin;

use App\Rw;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\RwRequest;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Kades;
use Illuminate\Support\Facades\Config;


class KetuaRwController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');


    }

    // public function index(Request $request){

    //     $rw = Rw::paginate(10);

    //     return view('rw.index', ['rw' => $rw]);
    // }

    public function index(Request $request){
        $rw = Rw::all();
        $kades = Kades::all();

        if ($request->ajax()) {
            $user = Rw::all();

            return DataTables::of($user)
            ->toJson();
        }
        return view('admin.rw-index', ['rw' => $rw, 'kades'=>$kades]);
    }


    public function show(Rw $rw){
        return view('rw.details', compact('rw'));
    }


    public function register(Request $request){


        $validator = Validator::make($request->all(), [
            'nik'=> 'required|unique:rw|max:16|min:16',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/rw')->with('false', 'Data Gagal Di Simpan');
        }else{
            $user = Rw::create([
                'nama' => $request->nama,
                'nik' =>  $request->nik,
                'rw' => $request->rw,
                'id_kades'=>$request->id_kades,
                'password' => bcrypt($request->password),
            ]);

            Config::set('jwt.user', 'App\Rw');
            Config::set('auth.providers.users.model', App\Rw::class);
            $credentials = $request->only('nama', 'nik', 'password');

            return redirect('/rw')->with('status', 'Data Berhasil di Simpan');
        }


    }

    // public function edit(Rw $rw){
    //     return view('rw.edit', compact('rw'));
    // }


    public function edit(Request $request){
        Rw::where('id', $request->input('id'))
        ->update([
            'nama' => $request->nama,
            'rw' => $request->rw,
            'password' => bcrypt($request->password)


        ]);

        return redirect('/rw')->with('true', 'Data Berhasil di Ubah');

    }

    public function delete(Request $request)
    {
        Rw::where('id',$request->input('id'))
        ->delete();

        return redirect('/rw')->with('true', 'Data berhasil di hapus');
    }
    public function update(Request $request, Rw $rw){


        Rw::where('id', $rw->id)

                    ->update([
                        'nama' => $request->nama,
                        'nik' => $request->nik,
                        'password' => bcrypt($request->password)
                    ]);
        return redirect('/rw')->with('status', 'Data Berhasil di Ubah');
    }
}
