<?php

namespace App\Http\Controllers;

use App\Warga;
use Validator;
use App\Allert;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AllertController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(),
        [

            'keterangan' => 'required',
        ]);

        if($validator->fails()){
            return [
                'status' =>false,
                'value' => '0',
                'message' => 'Masukkan Keterangan',
            ];
        }




        $store_berita = Allert::create();


        $store_berita->id_rt  = $request->input('id_rt');
        $store_berita->id_rw  = $request->input('id_rw');
        $store_berita->id_warga  = $request->input('id_warga');
        $store_berita->id_kades = $request->input('id_kades');

        $store_berita->keterangan = $request->input('keterangan');



        $store_berita->save();
        if ($store_berita) {
            return [
                'status'=>true,
                'value' => '1',
                'message' => 'Allert Berhasil di Tambahkan',
            ];
        }else{
            return [
                'value' => '0',
                'message' => 'Allert Berhasil di Tambahkan',
            ];
        }
    }



    public function storeAllert(Request $request){



        $allert = new \App\Allert;


        $allert->id_rt = $request->id_rt;
        $allert->id_warga = $request->id_warga;
        $allert->title = $request->title;
        $allert->keterangan = $request->keterangan;

        $allert->save();
        return [
            'status'=>true,
            'value' => '1',
            'message' => 'Pemberitahuan berhasil terkirim',
        ];
    }


    public function getAllert(){

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



   }


    public function fixx(Request $request){
        $url = 'https://fcm.googleapis.com/fcm/send';
        $key = 'AAAATeUwYkQ:APA91bFxZj0PKSOyIFcaT5MgpAk6KHoUi4SQVwQkT6oKhncWq1kHY2Rwe08q_SP9oK9DarsYVRrNTCOfBBDVv-qv4HxCP1dEBEZqSSeKwUQxBbk9kCZEHGgaIXWNvBhUDoHFyJ5aLBiT';




        $allert = new \App\Allert;

        $allert->id_rt = $request->id_rt;
        $allert->id_warga = $request->id_warga;
        $allert->nama_warga = $request->nama_warga;
        $allert->title = $request->title;
        $allert->keterangan = $request->keterangan;
        $allert->created_at = Carbon::now();

        $allert->save();

        $firebaseToken = Warga::where('id_rt', $allert->id_rt)
        ->whereNotNull('remember_token')
        ->pluck('remember_token');

        $data =[
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => "Pemberitahuan ! " ,
                "body" => "Berita Penting !",
                "click_action" => "NotifikasiActivity",
            ],
            "data" => [
                "Pengirim" => $allert->nama_warga,
                "Judul"  => $allert->title,
                "Keterangan" => $allert->keterangan,
                "Tanggal" => $allert->created_at
                ]

        ];



        // $firebaseToken = Warga::where('rt_id', $id)
        // ->whereNotNull('remember_token')
        // ->pluck('remember_token');


        // $data = [
        //     "registration_ids" => $firebaseToken,
        //     "notification" => [
        //         "title" => $request->title,
        //         "body" => "ss",
        //         "sound" => "default"

        //      ]
        //     ];

            $encodedData = json_encode($data);

            $headers = [
                'Authorization:key=' . $key,
                'Content-Type: application/json',
            ];


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
        echo $result;


    }
}
