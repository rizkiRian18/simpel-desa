<?php

namespace App\Http\Controllers;

use App\Warga;
use Validator;
use Carbon\Carbon;
use App\BeritaAcara;

use App\Exports\WargaExport;
use Illuminate\Http\Request;
use App\Exports\WargaAllExport;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\WargaRequest;
use App\Http\Resources\WargaResource;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Exceptions\JWTException;


class WargaController extends Controller
{

    public function __construct()
    {
        Auth::shouldUse('warga');
    }


    public function wargaregister(WargaRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'nik'=> 'required|unique:warga|max:16|min:16',
            'lampiran_kk' =>'required|max:1024',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'value' => '3',
                'message' => 'NIK sudah Terdaftar',

           ], 208);
        }

        $oldAkta = 'noimage.jpeg';
        $oldKTP = 'noimage.jpeg';


          //   UPLOAD AKTA !
          if($request->file('lampiran_kk') != '')
          {
              $upload_akta = $request->file('lampiran_kk');
              $lampiran_kk= $upload_akta->getClientOriginalName();
              $request->file('lampiran_kk')->move(public_path().'/img/lampiran_kk', $lampiran_kk);
          }else{
              $lampiran_kk = $oldAkta;
          }


            //   UPLOAD KTP !
            if($request->file('lampiran_ktp') != '')
            {
                $upload_akta = $request->file('lampiran_ktp');
                $lampiran_ktp = $upload_akta->getClientOriginalName();
                $request->file('lampiran_ktp')->move(public_path().'/img/lampiran_ktp', $lampiran_ktp);
            }else{
                $lampiran_ktp = $oldKTP;
            }



        // $user = Warga::create();

        // $user->id_rt = $request->input('id_rt');
        // $user->id_rw = $request->input('id_rw');
        // $user->id_kades = $request->input('id_kades');
        // $user->nama = $request->input('nama');
        // $user->nik = $request->input('nik');
        // $user->nomor_kk = $request->input('nomor_kk');
        // $user->alamat = $request->input('alamat');
        // $user->rt = $request->input('rt');
        // $user->rw = $request->input('rw');
        // $user->tempat_lahir = $request->input('tempat_lahir');
        // $user->tanggal_lahir = $request->input('tanggal_lahir');
        // $user->kewarganegaraan = $request->input('kewarganegaraan');
        // $user->agama = $request->input('agama');
        // $user->pekerjaan = $request->input('pekerjaan');
        // $user->alamat = $request->input('alamat');
        // $user->password = $request->input('password');
        // $user->lampiran_kk = $lampiran_kk;
        // $user->lampiran_ktp = $lampiran_ktp;
        // $user->save();

        $user = Warga::create([
            'nama' => $request->nama,
            'nik' =>  $request->nik,
            'id_rt'=> $request->id_rt,
            'id_rw' => $request->id_rw,
            'id_kades'=>$request->id_kades,
            'nomor_kk'=>$request->nomor_kk,
            'alamat'=>$request->alamat,
            'rt'=>$request->rt,
            'rw'=>$request->rw,
            'tempat_lahir'=>$request->tempat_lahir,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'kewarganegaraan'=>$request->kewarganegaraan,
            'agama'=>$request->agama,
            'pekerjaan'=>$request->pekerjaan,
            'lampiran_kk'=>$lampiran_kk,
            'lampiran_ktp'=>$lampiran_ktp,
            'password' => bcrypt($request->password),
        ]);

        Config::set('jwt.user', 'App\Warga');
		Config::set('auth.providers.users.model', App\Warga::class);
		$credentials = $request->only('nama', 'nik', 'password');

        $token = auth()->attempt($credentials);

        return response()->json([
            'status'=>true,
            'value' => '1',
            'message' => 'Data Warga Berhasil di Tambah',
            'token'=>$token,

       ], 200);

    // return (new WargaResource($request->user()))
    // ->additional(['meta' =>
    //  [
    //     'token' => $token,
    // ]]);
        }




    public function wargalogin(LoginRequest $request)
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


    public function cariiwarga(Request $request)
    {
        $nama   = $request->input('nik');
        $rt = $request->input('rt');


        $x = Warga::where('nik' , $nama)
        ->where('rt', $rt)
        ->get();



        if($x->isEmpty() ){
           return response()->json([
                'status' => false,
                'message' => 'Data Tidak di Temukan'

            ]);
        }

        return $x;
    }

    public function update(Request $request){


        $validator = Validator::make($request->all(), [
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 208);
        }

        Warga::where('id', $request->input('id'))
       ->update([
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


    public function wargacheck()
    {
        if (Auth::check()) {
            return response()->json([
                    'status' => true,
                    'response' => Auth::user(),
                    'message' => "Check success"
                ], 200);
        } else {
            return response()->json([
                    'status' => false,
                    'message' => "Check Error"
                ], 401);
        }
    }



    public function postTokenDevice(Request $request){




        Warga::where('id', $request->input('id'))
        ->update([
            'remember_token' => $request->remember_token
        ]);

        return [
            'status'=>true,
            'value' => '1',
            'message' => 'Data berhasil di Ubah',
        ];


        return "Data Berhasil Di Simpan";

   }

    public function wargart(Request $request)
    {

        $id   = $request->input('id');
        $x = Warga::where('id_rt' , $id)->orderBy('created_at', 'desc')
        ->get();
        if($x->isEmpty() ){
           return response()->json([
                'status' => false,
                'message' => 'Data Tidak di Temukan'
            ]);
        }

        return $x;
    }

    public function hapuswarga($id){
        $warga = Warga::find($id);
        $warga->delete();
        return [
            'status'=>true,
            'value' => '1',
            'message' => 'Data Warga Berhasil di Hapus',
        ];
    }

    public function ambilwarga(Request $request){
        $id   = $request->input('id');
        $x = Warga::where('id', $id)->get();
        if ($x->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak di Temukan'
            ]);
        }
        return $x;
    }

    public function updatewarga(Request $request, $id){



        $oldAkta = $request->input('lampiran_kk');
        $oldKTP = $request->input('lampiran_ktp');


          //   UPLOAD AKTA !
          if($request->file('lampiran_kk') != '')
          {
              $upload_akta = $request->file('lampiran_kk');
              $lampiran_kk= $upload_akta->getClientOriginalName();
              $request->file('lampiran_kk')->move(public_path().'/img/lampiran_kk', $lampiran_kk);
          }else{
              $lampiran_kk = $oldAkta;
          }


            //   UPLOAD KTP !
            if($request->file('lampiran_ktp') != '')
            {
                $upload_akta = $request->file('lampiran_ktp');
                $lampiran_ktp = $upload_akta->getClientOriginalName();
                $request->file('lampiran_ktp')->move(public_path().'/img/lampiran_ktp', $lampiran_ktp);
            }else{
                $lampiran_ktp = $oldKTP;
            }

        $warga = Warga::find($id);
        $warga->nama = $request->input('nama');
        $warga->nik = $request->input('nik');
        $warga->nomor_kk = $request->input('nomor_kk');
        $warga->tanggal_lahir = $request->input('tanggal_lahir');
        $warga->tempat_lahir = $request->input('tempat_lahir');
        $warga->jenis_kelamin = $request->input('jenis_kelamin');
        $warga->pekerjaan = $request->input('pekerjaan');
        $warga->agama = $request->input('agama');
        $warga->kewarganegaraan = $request->input('kewarganegaraan');
        $warga->alamat = $request->input('alamat');
        $warga->lampiran_kk = $lampiran_kk;
        $warga->lampiran_ktp = $lampiran_ktp;
        $warga->save();
        return [
            'status'=>true,
            'value' => '1',
            'message' => 'Data Warga Berhasil di Ubah',
        ];
      }



      public function updateKKWarga(Request $request, $id){


        $validator = Validator::make($request->all(),
        [
            'lampiran_kk' =>'max:1024|mimes:jpeg,png,jpg'
        ]);

        if($validator->fails()){
            return [
                'status' =>false,
                'value' => '0',
                'message' => 'Ukuran File Terlalu Besar',
            ];
        }



        $oldAkta = $request->input('lampiran_kk');



          //   UPLOAD AKTA !
          if($request->file('lampiran_kk') != '')
          {
              $upload_akta = $request->file('lampiran_kk');
              $lampiran_kk= $upload_akta->getClientOriginalName();
              $request->file('lampiran_kk')->move(public_path().'/img/lampiran_kk', $lampiran_kk);
          }else{
              $lampiran_kk = $oldAkta;
          }


        $warga = Warga::find($id);

        $warga->lampiran_kk = $lampiran_kk;
        $warga->save();
        return [
            'status'=>true,
            'value' => '1',
            'message' => 'Data Warga Berhasil di Ubah',
        ];
      }

      public function updateKTPWarga(Request $request, $id){


        $validator = Validator::make($request->all(),
        [
            'lampiran_ktp' =>'max:1024|mimes:jpeg,png,jpg'
        ]);

        if($validator->fails()){
            return [
                'status' =>false,
                'value' => '0',
                'message' => 'Ukuran File Terlalu Besar',
            ];
        }



        $oldAkta = $request->input('lampiran_ktp');



          //   UPLOAD AKTA !
          if($request->file('lampiran_ktp') != '')
          {
              $upload_akta = $request->file('lampiran_ktp');
              $lampiran_ktp= $upload_akta->getClientOriginalName();
              $request->file('lampiran_ktp')->move(public_path().'/img/lampiran_ktp', $lampiran_ktp);
          }else{
              $lampiran_ktp = $oldAkta;
          }


        $warga = Warga::find($id);

        $warga->lampiran_ktp = $lampiran_ktp;
        $warga->save();
        return [
            'status'=>true,
            'value' => '1',
            'message' => 'Data Warga Berhasil di Ubah',
        ];
      }



    public function warga()
    {
        $data = Warga::all('nik');
        return response()->json([
            'data' => $data
        ]);
    }

    public function wargaorder(){
        $data = Warga::all();
        return response()->json([
            'data' => $data
        ]);

    }


    public function exportWargaALL(){
        return Excel::download(new WargaAllExport, 'warga.xlsx');
    }


    public function exportWarga(Request $request){
        return Excel::download(new WargaExport($request->id), 'wargaRT.xlsx');
    }

        // BERITA

        public function getBerita(Request $request){

            $id_rt = $request->input('id_rt');
            $id_rw = $request->input('id_rw');
            $id_kades = $request->input('id_kades');

            $berita = BeritaAcara::where('id_rt', $id_rt)
                        ->orWhere('id_kades', $id_kades)
                        ->orWhere('id_rw', $id_rw)
                        ->orderBy('updated_at', 'desc')
                        ->get();

                        return $berita;

        }



    // WEB ADMIN




}

