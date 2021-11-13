<?php

namespace App\Http\Controllers;

use App\Rt;
use App\Rw;
use App\Kades;

use App\Warga;

use Validator;
use Carbon\Carbon;
use App\OrderSurat;
use App\BeritaAcara;
use Illuminate\Http\Request;
use App\Exports\KadesExportSurat;
use App\Exports\KadesExportWarga;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\KadesResource;
use Illuminate\Support\Facades\Config;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class KadesController extends Controller
{

    public function __construct()
    {
       Auth::shouldUse('kades');
    }
    public function kadeslogin(LoginRequest $request)
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

    public function kadesregister(Request $request){


        $validator = Validator::make($request->all(), [
            'nik'=> 'required|unique:rw|max:16|min:16',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = Kades::create([
            'nama' => $request->nama,
            'nik' =>  $request->nik,
            'password' => bcrypt($request->password),
        ]);

        Config::set('jwt.user', 'App\Kades');
		Config::set('auth.providers.users.model', App\Kades::class);
		$credentials = $request->only('nama', 'nik', 'password');

        $token = auth()->attempt($credentials);

        return (new KadesResource($request->user()))
                ->additional(['meta' =>
                 [
                    'token' => $token,
                ]]);
    }

    public function update(Request $request){

         Kades::where('id', $request->input('id'))
        ->update([
            'nama' => $request->nama,
            'password' => bcrypt($request->password)
        ]);

        return [
            'status'=>true,
            'value' => '1',
            'message' => 'Data berhasil di Ubah',
        ];



    }


    public function getRW(){

        $data = Rw::orderBy('rw', 'asc')->get();
        return $data;
    }
    public function getRT(Request $request){

        $id = $request->input('id_rw');

        $rt = Rt::where('id_rw', $id)
                ->orderBy('rt', 'asc')->get();
        return $rt;
    }
    public function getWarga(Request $request){


        $id_rt =$request->input('id_rt');

        $rt = Warga::where('id_rt', $id_rt)

                ->get();
        return $rt;
    }

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
        $date = Carbon::now();

        $store_berita->id_kades = $request->input('id_kades');
        $store_berita->judul_berita =$request->input('judul_berita');
        $store_berita->keterangan_berita = $request->input('keterangan_berita');
        $store_berita->lampiran_berita = $lampiran_berita;
        $store_berita->created_at = Carbon::now();
        $store_berita->updated_at = Carbon::now();


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
        $request->file('lampiran_berita')->move(public_path().'/img/lampiran_berita', $lampiran_berita);


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
                'message' => 'Berita Acara Berhasil di HUbah',
            ];
        }
    }

    public function deleteBerita($id)
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


    public function getberita(Request $request){

        $id   = $request->input('id');
        $berita = BeritaAcara::where('id_kades', $id)->get();

       return $berita;
    }



    public function getSurat(Request $request){

        $surat = OrderSurat::where('rw_status', "Di Setujui")
                ->get();

        return $surat;
    }




    public function countKK(){
        $warga = DB::table('warga')
        ->select([
            DB::raw('count(distinct nik) as jumlah_nik'),
            DB::raw('count(distinct nomor_kk) as jumlah_nomor_kk')
        ])

        ->get();
        return $warga;
    }


    public function countSurat(){
        $surat = DB::table('order_surat')
        ->where('rw_status' , "Di Setujui")
        ->select([
            DB::raw('count(nik) as jumlah_nik'),
        ])

        ->get();
        return $surat;
    }

    public function exportSurat(){
        return Excel::download(new KadesExportSurat, 'Data-Surat-Keterangan.xlsx');

    }

    public function exportWarga(){
        return Excel::download(new KadesExportWarga, 'Data-Warga.xlsx');

    }


}
