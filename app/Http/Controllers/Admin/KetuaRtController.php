<?php

namespace App\Http\Controllers\Admin;

use App\Rt;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\RtRequest;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class KetuaRtController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    // public function index(Request $request){



    //     if($request->has('search')){
    //         $rt = Rt::where('nama', 'like', '%'.$request->search.'%')->paginate(9);
    //     }else{
    //         $rt = Rt::orderBy('rt', 'asc')->paginate(9);
    //     }
    //         return view('rt.index', ['rt' => $rt]);
    // }


    public function index(Request $request){
        $rt = Rt::all();


        if ($request->ajax()) {
            $user = Rt::with('rttorw')->get();

            return DataTables::of($user)
            ->addColumn('rw', function(Rt $rt){
                if($rt->id_rw == null){
                    return 'none';
                }else{
                    return $rt->rttorw->rw;
                }

            })
            ->toJson();
        }
        return view('admin.rt-index', ['rt' => $rt]);
    }
    public function create(Rt $rt)
    {
        return view('rt.tambah');
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nik'=> 'required|unique:rt|max:16|min:16',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/rt')->with('error', 'Data Gagal Di Simpan');

        }else{
            $rt = Rt::create([
                'nama' => $request->nama,
                'nik' =>  $request->nik,
                'password' => bcrypt($request->password),
                'rt' => $request->rt,
            ]);

            Config::set('jwt.user', 'App\Rt');
            Config::set('auth.providers.users.model', App\Rt::class);
            $credentials = $request->only('nama', 'nik', 'password', 'rt');



            // return (new RtResource($request->user()))
            //         ->additional(['meta' =>
            //          [
            //             'token' => $token,
            //         ]]);
            return redirect('/rt')->with('status', 'Data Berhasil di Simpan');
        }



    }

    public function show(Rt $rt){
        return view('rt.details', compact('rt'));
    }
    public function edit(Rt $rt){
        return view('rt.edit', compact('rt'));
    }
    public function update(Request $request, Rt $rt){


        Rt::where('id', $rt->id)

                    ->update([
                        'nama' => $request->nama,
                        'nik' => $request->nik,
                        'password' => bcrypt($request->password)
                    ]);
        return redirect('/rt')->with('status', 'Data Berhasil di Ubah');
    }

}
