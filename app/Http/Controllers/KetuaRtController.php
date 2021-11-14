<?php

namespace App\Http\Controllers;

use App\Rt;
use App\Warga;
use Validator;

use App\OrderSurat;
use App\BeritaAcara;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Http\Requests\RtRequest;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\RtResource as RtResource;

class KetuaRtController extends Controller
{


    public function __construct()
    {

       Auth::shouldUse('rt');

    }


    public function rtregister(RtRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'nik'=> 'required|unique:rt|max:16|min:16',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 208);
        }

        $user = Rt::create([
            'id_rw'=>$request->id_rw,
            'id_kades'=>$request->id_kades,
            'nama' => $request->nama,
            'nik' =>  $request->nik,
            'password' => bcrypt($request->password),
            'rt' => $request->rt,
            'rw' => $request->rw,
        ]);

        Config::set('jwt.user', 'App\Rt');
		Config::set('auth.providers.users.model', App\Rt::class);
		$credentials = $request->only('nama', 'nik', 'password', 'rt');

        $token = auth()->attempt($credentials);

        return (new RtResource($request->user()))
                ->additional(['meta'=>
                 [
                    'token' => $token,
                ]]);

    }


    public function update(Request $request){


        $validator = Validator::make($request->all(), [
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 208);
        }

        Rt::where('id', $request->input('id'))
       ->update([
           'nama' => $request->nama,
           'nik' => $request->nik,
           'rt' => $request->rt,
           'password' => bcrypt($request->password)
       ]);


        // $rt = Rt::find($id);
        // $rt->nama = $request->input('nama');
        // $rt->nik = $request->input('nik');
        // $rt->password = bcrypt($request->input('password'));
        // $rt->rt = $request->input('rt');

       return [
           'status'=>true,
           'value' => '1',
           'message' => 'Data berhasil di Ubah',
       ];



   }

    public function rtlogin(LoginRequest $request)
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

        public function rtcheck()
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








        public function searchwarga(Request $request, $id)
        {
            $cari = $request->cari;


           $warga = DB::table('warga')
           ->where('nama', 'like', "%".$cari."%")->get();



            if($warga->isEmpty() ){
               return response()->json([
                    'status' => false,
                    'message' => 'Data Tidak di Temukan'

                ]);
            }else{
                return response($warga);
            }


        }


        public function wargart(Request $request)
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


        public function searchRTwarga(Request $request){


            $id = $request->input('id_rt');

            $key = $request->key;

            $warga = Warga::where('id_rt', $id)
            ->where('nama', 'like',"%".$key."%")
            ->get();



             if ($warga->isEmpty()) {
                 return response()->json([
                    'value' => '0',
                     'status' => false,
                     'message' => 'Data Tidak di Temukan'

                 ],401);
             } return $warga;
        }

        public function countwargaRT(Request $request){
            $id = $request->input('id_rt');

            $warga = Warga::where('id_rt', $id)
            ->select(

                DB::raw('count(distinct nik) as jumlah_nik'),
                DB::raw('count(distinct nomor_kk) as jumlah_nomor_kk')
            )

            ->get();

                return $warga;



        }


        public function hitungKK(Request $request){
            $id = $request->input('id_rt');

            $warga = Warga::where('id_rt', $id)->select([
                DB::raw('count(distinct nik) as jumlah_nik'),
                DB::raw('nomor_kk as nomor_kk')
            ])


            ->groupBy('nomor_kk')
            ->get();
            return $warga;
        }


        public function countSuratRT(Request $request){
            $id = $request->input('id_rt');

            $surat = OrderSurat::where('id_rt', $id)
            ->count();


            return response()->json([
                'jumlah_nik' => $surat
            ]);
        }


        // BERITA

        public function getBerita(Request $request){

            $id = $request->input('id');
            $id_rw = $request->input('id_rw');
            $id_kades = $request->input('id_kades');

            $berita = BeritaAcara::where('id_rt', $id)
                        ->orWhere('id_kades', $id_kades)
                        ->orWhere('id_rw', $id_rw)
                        ->orderBy('updated_at', 'desc')
                        ->get();

                        return $berita;

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
            $store_berita->id_rt = $request->input('id_rt');
            // $store_berita->id_kades = $request->input('id_kades');
            // $store_berita->id_rw = $request->input('id_rw');
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
            $request->file('lampiran_berita')->move(public_path().'/img/lampiran_berita', $lampiran_berita);


            $data = BeritaAcara::find($id);
            $data->id_rt = $request->input('id_rt');
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
                    'message' => 'Berita Acara Berhasil di Ubah',
                ];
            }
        }





        // public function countKkRt(){
        //     $warga = DB::table('warga')
        //     ->select([
        //         DB::raw('count(distinct nik) as jumlah_nik'),
        //         DB::raw('nomor_kk as nomor_kk')
        //     ])

        //     ->groupBy('nomor_kk')
        //     ->get();
        //     return $warga;
        // }
    }



