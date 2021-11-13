<?php

namespace App\Http\Controllers\Admin;

use App\Warga;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WargaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }


    // public function index(Request $request){



    //     // dd($request->cari);

    //     if($request->has('search')){

    //         $warga = Warga::where('nik', 'like', '%'.$request->search.'%')->paginate(15);

    //     }else{
    //         $warga = Warga::orderBy('rt', 'asc')->paginate(15);
    //     }
    //         return view('warga.index', ['warga' => $warga]);
    // }

    public function index(Request $request){
        $warga = Warga::all();


        if ($request->ajax()) {
            $user = Warga::all();

            return DataTables::of($user)
            ->toJson();
        }
        return view('admin.warga-index', ['warga' => $warga]);
    }


    public function show(Warga $warga){
        return view('warga.details', compact('warga'));
    }

    public function edit(Warga $warga){
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga){


        Warga::where('id', $warga->id)

                    ->update([

                        'password' => bcrypt($request->password)
                    ]);
        return redirect('/warga')->with('status', 'Data Berhasil di Ubah');
    }
}
