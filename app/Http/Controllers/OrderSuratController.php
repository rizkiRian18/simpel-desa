<?php

namespace App\Http\Controllers;

use App\Rt;
use App\Warga;
use Validator;
use Carbon\Carbon;
use App\OrderSurat;
use Illuminate\Http\Request;
use App\Exports\SuratRTExport;
use App\Exports\OrderSuratExport;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\OrderSuratRequest;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\OrderSurat as OrderSuratResouce;

class OrderSuratController extends Controller

{

        public function ordersurat(OrderSuratRequest $request)
            {



                    $validator = Validator::make($request->all(),
                        [
                            'nik'   => 'required',
                            'maksud_surat' => 'required',
                            'nama'  => 'required',
                            'tempat_lahir' => 'required',
                            'tanggal_lahir' => 'required',
                            'jenis_kelamin' => 'required',
                            'nomor_kk'   => 'required',
                            'kewarganegaraan' => 'required',
                            'pekerjaan' => 'required',
                            'agama' => 'required',
                            'rt' => 'required',
                            'rw' => 'required',
                            'alamat' => ' required'
                         ]);

                                if ($validator->fails()) {
                                    return response()->json($validator->errors());
                                }




                    $order_surat = OrderSurat::create
                        ([
                            'id_warga' => $request->id_warga,
                            'id_rt' => $request->id_rt,
                            'id_rw' => $request->id_rw,
                            'nik'  => $request->nik,
                            'maksud_surat' => $request->maksud_surat,
                            'nama' =>$request->nama,
                            'author' =>$request->author,
                            'tempat_lahir' => $request->tempat_lahir,
                            'tanggal_lahir' => $request->tanggal_lahir,
                            'jenis_kelamin' => $request->jenis_kelamin,
                            'nomor_kk' => $request->nomor_kk,
                            'kewarganegaraan' => $request->kewarganegaraan,
                            'pekerjaan' => $request->pekerjaan,
                            'agama' => $request->agama,
                            'rt' => $request->rt,
                            'rw' => $request->rw,
                            'alamat' => $request->alamat,

                        ]);

                        $order_surat->save();
                        if ($order_surat) {
                            return [
                                'value' => '1',
                                'message' => 'Surat Keterangan Berhasil Sudah Terkirim',
                            ];
                        }else{
                            return [
                                'value' => '0',
                                'message' => 'Surat Keterangan Gagal Terkirim',
                            ];
                        }

        }


        public function rtScheck(Request $request)
        {
            $id   = $request->input('id');
            $x    = OrderSurat::where('id_rt' , $id)
                    ->orderBy('created_at', 'desc')
                    ->get();

            if($x->isEmpty() ){
               return response()->json([
                    'status' => false,
                    'message' => 'Data Tidak di Temukan'
                ]);
            }
            return $x;
        }

        public function wargaScheck(Request $request){


            $id = $request->input('id');
            $x = OrderSurat::where('id_warga' , $id)->orderBy('id', 'desc')

            ->get();


            if($x->isEmpty() ){
               return response()->json([
                    'status' => false,
                    'message' => 'Data Tidak di Temukan'
                ]);
            }else{


                return $x;
            }
        }

        public function rtSvalidasi(Request $request, $id)
        {


            $validator = Validator::make($request->all(), [
                'ttd_rt' => 'file|nullable|max:2048',
                'nomor_urut_rt' => 'required',
                'feedback_rt' => 'required',
                'rt_status' => 'required',
            ]);

            if ($validator->fails()) {
                return [
                    'value' => '3',
                    'message' => 'File Gambar Terlalu Besar',
                ];
            }

            // TTD RT
            if($request->hasFile('ttd_rt')){
                // ada file yang diupload
                $gambar_ttd = $request->file('ttd_rt');
                $ttd_rt = $gambar_ttd->getClientOriginalName();
                $request->file('ttd_rt')->move(public_path().'/img/lampiran_ttd_rt', $ttd_rt);

            }else{
                // tidak ada file yang diupload

                $ttd_rt = 'noimage.jpg';
            }
            // $gambar_ttd = $request->file('ttd_rt');
            // $ttd_rt = $gambar_ttd->getClientOriginalName();
            // $request->file('ttd_rt')->storeAs('public/berkas/', $ttd_rt);


            $surat = OrderSurat::findOrFail($id);
            $surat->feedback_rt = $request->input('feedback_rt');
            $surat->nomor_urut_rt = $request->input('nomor_urut_rt');
            $surat->rt_status =$request->input('rt_status');
            $surat->ttd_rt= $ttd_rt;

            $surat->save();
            if ($surat) {
                return [
                    'value' => '1',
                    'message' => 'Update Surat Berhasil',
                ];
            }else{
                return [
                    'value' => '0',
                    'message' => 'Update Surat Gagal',
                ];
            }

        }


        public function kirimSurat(Request $request, $id){
            $surat = OrderSurat::findOrFail($id);
            $surat->validasi_kades = $request->input('validasi_kades');
            $surat->save();
            if ($surat) {
                return [
                    'value' => '1',
                    'message' => 'Update Surat Berhasil',
                ];
            }else{
                return [
                    'value' => '0',
                    'message' => 'Update Surat Gagal',
                ];
            }
        }




        public function tambahLampiranSatu(Request $request, $id){



            $validator = Validator::make($request->all(), [
                'lampiran_satu' => 'file|nullable|max:2048',
            ]);



            if ($validator->fails()) {
                return [
                    'value' => '3',
                    'message' => 'File Gambar Terlalu Besar',
                ];
            }
             //Lampiran 1
             if($request->hasFile('lampiran_satu')){
                // ada file yang diupload
                $gambar_lampiran_satu = $request->file('lampiran_satu');
                $lampiran_satu = $gambar_lampiran_satu->getClientOriginalName();
                $request->file('lampiran_satu')->move(public_path().'/img/lampiran_surat', $lampiran_satu);

            }else{
                // tidak ada file yang diupload

                $lampiran_satu= 'noimage.jpg';
            }

            $surat = OrderSurat::find($id);
            $surat->lampiran_satu = $lampiran_satu;
            $surat->save();
            return [
                'status'=>true,
                'value' => '1',
                'message' => 'Data Warga Berhasil di Ubah',
            ];
        }


        public function tambahLampiranDua(Request $request, $id){



            $validator = Validator::make($request->all(), [
                'lampiran_dua' => 'file|nullable|max:2048',
            ]);



            if ($validator->fails()) {
                return [
                    'value' => '3',
                    'message' => 'File Gambar Terlalu Besar',
                ];
            }
             //Lampiran 1
             if($request->hasFile('lampiran_dua')){
                // ada file yang diupload
                $gambar_lampiran_dua = $request->file('lampiran_dua');
                $lampiran_dua = $gambar_lampiran_dua->getClientOriginalName();
                $request->file('lampiran_dua')->move(public_path().'/img/lampiran_surat', $lampiran_dua);

            }else{
                // tidak ada file yang diupload

                $lampiran_dua= 'noimage.jpg';
            }

            $surat = OrderSurat::find($id);
            $surat->lampiran_dua = $lampiran_dua;
            $surat->save();
            return [
                'status'=>true,
                'value' => '1',
                'message' => 'Data Warga Berhasil di Ubah',
            ];
        }

        public function tambahLampiranTiga(Request $request, $id){



            $validator = Validator::make($request->all(), [
                'lampiran_tiga' => 'file|nullable|max:2048',
            ]);



            if ($validator->fails()) {
                return [
                    'value' => '3',
                    'message' => 'File Gambar Terlalu Besar',
                ];
            }
             //Lampiran 1
             if($request->hasFile('lampiran_tiga')){
                // ada file yang diupload
                $gambar_lampiran_tiga = $request->file('lampiran_tiga');
                $lampiran_tiga = $gambar_lampiran_tiga->getClientOriginalName();
                $request->file('lampiran_tiga')->move(public_path().'/img/lampiran_surat', $lampiran_tiga);

            }else{
                // tidak ada file yang diupload

                $lampiran_tiga= 'noimage.jpg';
            }

            $surat = OrderSurat::find($id);
            $surat->lampiran_tiga = $lampiran_tiga;
            $surat->save();
            return [
                'status'=>true,
                'value' => '1',
                'message' => 'Data Warga Berhasil di Ubah',
            ];
        }



        public function tambahLampiranEmpat(Request $request, $id){



            $validator = Validator::make($request->all(), [
                'lampiran_empat' => 'file|nullable|max:2048',
            ]);



            if ($validator->fails()) {
                return [
                    'value' => '3',
                    'message' => 'File Gambar Terlalu Besar',
                ];
            }
             //Lampiran 1
             if($request->hasFile('lampiran_empat')){
                // ada file yang diupload
                $gambar_lampiran_empat = $request->file('lampiran_empat');
                $lampiran_empat = $gambar_lampiran_empat->getClientOriginalName();
                $request->file('lampiran_empat')->move(public_path().'/img/lampiran_surat', $lampiran_empat);

            }else{
                // tidak ada file yang diupload

                $lampiran_empat= 'noimage.jpg';
            }

            $surat = OrderSurat::find($id);
            $surat->lampiran_empat = $lampiran_empat;
            $surat->save();
            return [
                'status'=>true,
                'value' => '1',
                'message' => 'Data Warga Berhasil di Ubah',
            ];
        }



        public function tambahLampiranLima(Request $request, $id){



            $validator = Validator::make($request->all(), [
                'lampiran_lima' => 'file|nullable|max:2048',
            ]);



            if ($validator->fails()) {
                return [
                    'value' => '3',
                    'message' => 'File Gambar Terlalu Besar',
                ];
            }
             //Lampiran 1
             if($request->hasFile('lampiran_lima')){
                // ada file yang diupload
                $gambar_lampiran_lima = $request->file('lampiran_lima');
                $lampiran_lima = $gambar_lampiran_lima->getClientOriginalName();
                $request->file('lampiran_lima')->move(public_path().'/img/lampiran_surat', $lampiran_lima);

            }else{
                // tidak ada file yang diupload

                $lampiran_lima= 'noimage.jpg';
            }

            $surat = OrderSurat::find($id);
            $surat->lampiran_lima = $lampiran_lima;
            $surat->save();
            return [
                'status'=>true,
                'value' => '1',
                'message' => 'Data Warga Berhasil di Ubah',
            ];
        }


        public function tambahLampiranEnam(Request $request, $id){



            $validator = Validator::make($request->all(), [
                'lampiran_enam' => 'file|nullable|max:2048',
            ]);



            if ($validator->fails()) {
                return [
                    'value' => '3',
                    'message' => 'File Gambar Terlalu Besar',
                ];
            }
             //Lampiran 1
             if($request->hasFile('lampiran_enam')){
                // ada file yang diupload
                $gambar_lampiran_enam = $request->file('lampiran_enam');
                $lampiran_enam = $gambar_lampiran_enam->getClientOriginalName();
                $request->file('lampiran_enam')->move(public_path().'/img/lampiran_surat', $lampiran_enam);

            }else{
                // tidak ada file yang diupload

                $lampiran_enam= 'noimage.jpg';
            }

            $surat = OrderSurat::find($id);
            $surat->lampiran_enam = $lampiran_enam;
            $surat->save();
            return [
                'status'=>true,
                'value' => '1',
                'message' => 'Data Warga Berhasil di Ubah',
            ];
        }


        public function tambahLampiranTujuh(Request $request, $id){



            $validator = Validator::make($request->all(), [
                'lampiran_tujuh' => 'file|nullable|max:2048',
            ]);



            if ($validator->fails()) {
                return [
                    'value' => '3',
                    'message' => 'File Gambar Terlalu Besar',
                ];
            }
             //Lampiran 1
             if($request->hasFile('lampiran_tujuh')){
                // ada file yang diupload
                $gambar_lampiran_tujuh = $request->file('lampiran_tujuh');
                $lampiran_tujuh = $gambar_lampiran_tujuh->getClientOriginalName();
                $request->file('lampiran_tujuh')->move(public_path().'/img/lampiran_surat', $lampiran_tujuh);

            }else{
                // tidak ada file yang diupload

                $lampiran_tujuh= 'noimage.jpg';
            }

            $surat = OrderSurat::find($id);
            $surat->lampiran_tujuh = $lampiran_tujuh;
            $surat->save();
            return [
                'status'=>true,
                'value' => '1',
                'message' => 'Data Warga Berhasil di Ubah',
            ];
        }


        public function rtEditKomentar(Request $request, $id)
        {


            $surat = OrderSurat::find($id);
            $surat->feedback_rt = $request->input('feedback_rt');
            $surat->save();
            return [
                'status'=>true,
                'value' => '1',
                'message' => 'Komentar Berhasil di Ubah',
            ];



        }


        public function rwEditKomentar(Request $request, $id)
        {


            $surat = OrderSurat::find($id);
            $surat->feedback_rw = $request->input('feedback_rw');
            $surat->save();
            return [
                'status'=>true,
                'value' => '1',
                'message' => 'Komentar Berhasil di Ubah',
            ];

        }


        public function kadesEditKomentar(Request $request, $id)
        {


            $surat = OrderSurat::find($id);
            $surat->feedback_kades = $request->input('feedback_kades');
            $surat->save();
            return [
                'status'=>true,
                'value' => '1',
                'message' => 'Komentar Berhasil di Ubah',
            ];

        }


        public function rwScheck(Request $request)
        {
            $id   = $request->input('id');

            $x = OrderSurat::where('id_rw', $id)
            ->where('rt_status' , "Di Setujui")->orderBy('created_at', 'desc')
                    ->get();
            if($x->isEmpty() ){
               return response()->json([
                    'status' => false,
                    'message' => 'Data Tidak di Temukan'
                ]);
            }
            return $x;
        }



        public function rwvalidasi(Request $request, $id)
        {


            $validator = Validator::make($request->all(), [
                'ttd_rw' => 'nullable|max:2048',
                'rw_status' => 'required',

            ]);

            if ($validator->fails()) {
                // return response()->json($validator->errors());
                return [
                    'value' => '3',
                    'message' => 'File Gambar Terlalu Besar',
                ];
            }



            // TTD RT
            if($request->hasFile('ttd_rw')){
                // ada file yang diupload
                $gambar_ttd = $request->file('ttd_rw');
                $ttd_rw = $gambar_ttd->getClientOriginalName();
                $request->file('ttd_rw')->move(public_path().'/img/lampiran_ttd_rw', $ttd_rw);

            }else{
                // tidak ada file yang diupload

                $ttd_rw = 'noimage.jpg';
            }

            // // TTD RT

            // $gambar_ttd = $request->file('ttd_rw');
            // $ttd_rw = $gambar_ttd->getClientOriginalName();
            // $request->file('ttd_rw')->storeAs('public/berkas/', $ttd_rw);


            $surat = OrderSurat::findOrfail($id);
            $surat->nomor_urut_rw = $request->input('nomor_urut_rw');
            $surat->feedback_rw = $request->input('feedback_rw');
            $surat->rw_status =$request->input('rw_status');
            $surat->validasi_kades = $request->input('validasi_kades');
            $surat->ttd_rw= $ttd_rw;

            $surat->save();
            if ($surat) {
                return [
                    'value' => '1',
                    'message' => 'Update Surat Berhasil',
                ];
            }else{
                return [
                    'value' => '0',
                    'message' => ' Update Surat  Gagal',
                ];
            }

        }


        public function kadesValidasi(Request $request, $id){

            $surat = OrderSurat::findOrfail($id);
            $surat->kades_status = $request->input('kades_status');
            $surat->save();
            if ($surat) {
                return [
                    'value' => '1',
                    'message' => 'Update Surat Berhasil',
                ];
            }else{
                return [
                    'value' => '0',
                    'message' => ' Update Surat  Gagal',
                ];
            }


        }



        public function downloadFileKades($filename){


            return response()->download(public_path('/filesurat/surat_desa/' . $filename));




        }

        public function kadesUploadFile(Request $request, $id){

            $validator = Validator::make($request->all(), [
                "file_kades" => "required|mimes:pdf"

            ]);

            if ($validator->fails()) {
                // return response()->json($validator->errors());
                return [
                    'value' => '3',
                    'message' => 'File Gambar Terlalu Besar',
                ];
            }



              if($request->file('file_kades')){
                // ada file yang diupload
                $gambfile = $request->file('file_kades');
                $file = $gambfile->getClientOriginalName();
                $request->file('file_kades')->move(public_path().'/img/surat_desa', $file);

            }else{
                // tidak ada file yang diupload

                $file = 'nofile.pdf';
            }


            $surat = OrderSurat::findOrfail($id);
            $surat->file_kades = $file;
            $surat->kades_status = $request->input('kades_status');
            $surat->save();
            if ($surat) {
                return [
                    'value' => '1',
                    'message' => 'Update Surat Berhasil',
                ];
            }else{
                return [
                    'value' => '0',
                    'message' => ' Update Surat  Gagal',
                ];
            }
        }

        public function kadesPermission(Request $request, $id){

            $surat = OrderSurat::findOrfail($id);
            $surat->tambah_lampiran = $request->input('tambah_lampiran');
            $surat->save();
            if ($surat) {
                return [
                    'value' => '1',
                    'message' => 'Update Surat Berhasil',
                ];
            }else{
                return [
                    'value' => '0',
                    'message' => ' Update Surat  Gagal',
                ];
            }

        }


        public function searchSurat(Request $request){



            $key = $request->key;

            $x = OrderSurat::where('rt_status' , "Di Setujui")
            ->where('nama', 'like',"%".$key."%")
            ->get();



             if ($x->isEmpty()) {
                 return response()->json([
                    'value' => '0',
                     'status' => false,
                     'message' => 'Data Tidak di Temukan'

                 ],401);
             } return $x;
        }

        public function searchSuratRT(Request $request){


            $id   = $request->input('id_rt');
            $key = $request->key;

            $x = OrderSurat::where('id_rt' , $id)
            ->where('nama', 'like',"%".$key."%")
            ->get();



             if ($x->isEmpty()) {
                 return response()->json([
                    'value' => '0',
                     'status' => false,
                     'message' => 'Data Tidak di Temukan'

                 ],401);
             } return $x;
        }









        public function exportSuratRT(Request $request){
            // return Excel::download(new WargaExport, 'warga.xlsx');

            return Excel::download(new SuratRTExport($request->id), 'Data-Surat-Keterangan.xlsx');
        }


        public function exportSuratRW(Request $request){
            // return Excel::download(new WargaExport, 'warga.xlsx');

            return Excel::download(new OrderSuratExport, 'Data-Surat-Keterangan.xlsx');
        }







    }




