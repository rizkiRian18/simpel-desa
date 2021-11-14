<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Warga;
use App\Rt;
use App\BeritaAcara;
use App\Http\Requests\BeritaAcaraRequest;
use Carbon\Carbon;
use Validator;

class BeritaAcaraController extends Controller
{
    public function storeBerita(Request $request){

            $validator = Validator::make($request->all(),
            [
                'judul_berita' => 'required',
                'keterangan_berita' => 'required',
                'lampiran_berita' =>'required|max:1024'
            ]);

            if($validator->fails()){
                return [
                    'status' =>false,
                    'value' => '0',
                    'message' => 'File Gambar Terlalu Besar',
                ];
            }


            $gambar_berita = $request->file('lampiran_berita');
            $lampiran_berita = $gambar_berita->getClientOriginalName();
            $request->file('lampiran_berita')->move(public_path().'/img/lampiran_berita', $lampiran_berita);


            $store_berita = BeritaAcara::create();



            $store_berita->id_rt  = $request->input('id_rt');
            $store_berita->id_rw  = $request->input('id_rw');
            $store_berita->id_kades = $request->input('id_kades');
            $store_berita->judul_berita =$request->input('judul_berita');
            $store_berita->keterangan_berita = $request->input('keterangan_berita');
            $store_berita->lampiran_berita = $lampiran_berita;
            $store_berita->created_at = Carbon::now();


            $store_berita->save();
            if ($store_berita) {
                return [
                    'status'=>true,
                    'value' => '1',
                    'message' => 'Berita Acara Berhasil Di Tambahkan',
                ];
            }else{
                return [
                    'value' => '0',
                    'message' => 'Berita Acara Gagal Di Tambahkan',
                ];
            }
    }


    public function getBerita()
    {

        $data = BeritaAcara::orderBy('updated_at', 'desc')->get();
        return $data;
    }


    public function dropBerita($id)
    {
        $data = BeritaAcara::find($id);
        $data->delete();
        if ($data) {
            return [
                'value' => '1',
                'message' => 'Berita Acara Berhasil Di Hapus',
            ];
        }else{
            return [
                'value' => '0',
                'message' => 'Berita Acara Berhasil di Hapus',
            ];
        }
    }

    public function updateBerita(Request $request, $id){


        $validator = Validator::make($request->all(),
        [
            'judul_berita' => 'required',
            'keterangan_berita' => 'required',
            'lampiran_berita' =>'required|max:1024'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $gambar_berita = $request->file('lampiran_berita');
        $lampiran_berita = $gambar_berita->getClientOriginalName();
        $request->file('lampiran_berita')->storeAs('public/berkas/', $lampiran_berita);


        $data = BeritaAcara::find($id);
        $data->id_kades = $request->input('id_kades');
        $data->judul_berita = $request->input('judul_berita');
        $data->keterangan_berita = $request->input('keterangan_berita');
        $data->lampiran_berita = $lampiran_berita;

        $data->save();
        if ($data) {
            return [
                'value' => '1',
                'message' => 'Berita Acara Berhasil Di Ubah',
            ];
        }else{
            return [
                'value' => '0',
                'message' => 'Berita Acara Berhasil di Ubah',
            ];
        }
    }
}
