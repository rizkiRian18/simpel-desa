<?php

namespace App\Http\Controllers;

use App\Rt;
use App\Rw;
use App\Warga;
use Validator;
use App\OrderSurat;



use App\BeritaAcara;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\RwRequest;
use App\Exports\KetuaRWEportSurat;


use App\Http\Resources\RtResource;
use Illuminate\Support\Facades\DB;

use App\Exports\KetuaRWExportWarga;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\RwResource as RwResource;

class KetuaRwController extends Controller
{
    public function __construct()
    {
       Auth::shouldUse('rw');
    }

    public function register(RwRequest $request){


        $validator = Validator::make($request->all(), [
            'nik'=> 'required|unique:rw|max:16|min:16',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = Rw::create([
            'id_kades' =>$request->id_rw,
            'nama' => $request->nama,
            'nik' =>  $request->nik,
            'password' => bcrypt($request->password),
        ]);

        Config::set('jwt.user', 'App\Rw');
		Config::set('auth.providers.users.model', App\Rw::class);
		$credentials = $request->only('nama', 'nik', 'password');

        $token = auth()->attempt($credentials);

        return (new RwResource($request->user()))
                ->additional(['meta' =>
                 [
                    'token' => $token,
                ]]);
    }


    public function update(Request $request){

    Rw::where('id', $request->input('id'))
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

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('nik', 'password');

        try{
            if(!$token = auth()->attempt($credentials))
            {

                return response()->json([
                    'status' => false,
                    'message' => 'Invalid_Credentials'], 401);
            }
        }catch (JWTException $e)
        {
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

        public function check()
        {
            if(Auth::check()){
                return response()->json([
                    'status' => true,
                    'response' => Auth::user(),
                    'message' => "Check success"
                ], 200);
            }

            else{
                return response()->json([
                    'status' => false,
                    'message' => "Check Error"
                ], 401);
            }
        }


        public function countKK(Request $request){
            $id = $request->input('id_rw');
            $warga = Warga::where('id_rw', $id)
            ->select([
                DB::raw('count(distinct nik) as jumlah_nik'),
                DB::raw('count(distinct nomor_kk) as jumlah_nomor_kk')
            ])

            ->get();
            return $warga;
        }


        public function countSurat(Request $request){
            $id = $request->input('id_rw');
            $surat = OrderSurat::where('id_rw', $id)
            ->where('rt_status' , "Di Setujui")
            ->select([
                DB::raw('count(nik) as jumlah_nik'),
            ])

            ->get();
            return $surat;
        }


        public function exportSurat(Request $request){
            return Excel::download(new KetuaRWEportSurat($request->id), 'Data-Surat-Keterangan.xlsx');

        }
        public function exportWarga(Request $request){
            return Excel::download(new KetuaRWExportWarga($request->id), 'Data-Warga.xlsx');

        }

        // Beritaa
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

            $store_berita->id_rw = $request->input('id');
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
            $data->id_rw = $request->input('id_rw');
            $data->judul_berita = $request->input('judul_berita');
            $data->keterangan_berita = $request->input('keterangan_berita');
            $data->lampiran_berita = $lampiran_berita;
            $data->updated_at = Carbon::now();


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

        public function getBerita(Request $request){

            $id_rw = $request->input('id_rw');
            $id_kades = $request->input('id_kades');

            $berita = BeritaAcara::where('id_rw', $id_rw)
                        ->Orwhere('id_kades', $id_kades)
                        ->orderBy('updated_at', 'desc')
                        ->get();

            return $berita;
    }







    public function getWargaTiapRT(Request $request)
    {

        $id   = $request->input('id');
        $x = Warga::where('id_rt' , $id)->get();
        if($x->isEmpty() ){
           return response()->json([
                'status' => false,
                'message' => 'Data Tidak di Temukan'
            ]);
        }

        return $x;
    }



    public function getRT(Request $request){

        $id = $request->input('id_rw');

        $rt = Rt::where('id_rw', $id)
                ->orderBy('rt', 'asc')->get();
        return $rt;
    }

    public function getWarga(Request $request){

        $id_rw= $request->input('id_rw');
        $id_rt =$request->input('id_rt');

        $rt = Warga::where('id_rt', $id_rt)
                ->orderBy('rt', 'asc')->get();
        return $rt;
    }





    public function getSurat(Request $request){

        $id_rw= $request->input('id_rw');
        $surat = OrderSurat::where('id_rw', $id_rw)
                ->where('rt_status', "Di Setujui")
                ->orderBy('created_at', 'desc')
                ->get();

        return $surat;
    }


    public function rwvalidasi(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [

            'nomor_urut_rw' => 'required',
            'sk_rw' => 'required',
            'rw_status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        // TTD RT

        $gambar_ttd = $request->file('ttd_rw');
        $ttd_rw = $gambar_ttd->getClientOriginalName();
        $request->file('ttd_rw')->storeAs('public/berkas', $ttd_rw);


        $surat = OrderSurat::findOrFail($id);
        $surat->sk_rt = $request->input('sk_rw');
        $surat->nomor_urut_rt = $request->input('nomor_urut_rw');
        $surat->rt_status =$request->input('rw_status');
        $surat->ttd_rt= $ttd_rw;

        $surat->save();
        if ($surat) {
            return [
                'value' => '1',
                'message' => 'Berhasil Bos',
            ];
        }else{
            return [
                'value' => '0',
                'message' => 'Gagal Bos',
            ];
        }

    }



    public function countwarga (){

        $warga = DB::table('warga')->count();
        return $warga;
    }













}
