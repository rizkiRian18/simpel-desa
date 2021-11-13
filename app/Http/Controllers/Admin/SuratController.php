<?php

namespace App\Http\Controllers\Admin;

use App\OrderSurat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;


class SuratController extends Controller
{


    public function index(Request $request){
        $orderSurat = OrderSurat::all();


        if ($request->ajax()) {
            $surat = OrderSurat::all();

            return DataTables::of($surat)
            ->toJson();
        }
        return view('admin.surat-index', ['orderSurat' => $orderSurat]);
    }




    public function edit(Request $request){

        $old_lampiran = $request->hidden_file_kades;

        if($request->file('file_kades') != '')
        {
            $upload_lampiran = $request->file('file_kades');
            $lampiran = $upload_lampiran->getClientOriginalName();
            $request->file('file_kades')->move(public_path().'/filesurat/surat_desa', $lampiran);
        }else{
            $lampiran = $old_lampiran;
        }

        OrderSurat::where('id', $request->input('id'))
        ->update([
            'kades_status' => $request->kades_status,
            'file_kades'=> $lampiran

        ]);

        return redirect('/surat')->with('true', 'Data Berhasil di Ubah');

    }
}
