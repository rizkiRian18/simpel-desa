<?php

namespace App\Exports;

use App\OrderSurat;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class KadesExportSurat implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function collection()
    {
        return OrderSurat::where('rw_status' , "Di Setujui")->orderBy('rw', 'asc')->get([
           'sk_rw','sk_rt',  'nama', 'nik', 'nomor_kk','rt','rw','alamat', 'jenis_kelamin','tempat_lahir', 'tanggal_lahir','agama','kewarganegaraan','pekerjaan','maksud_surat','created_at'
        ]);
    }

    public function headings():array

    {
            return [

                'SK RW',
                'SK RT',
                'NAMA PEMOHON',
                'NIK',
                'NOMOR KK',
                'RT',
                'RW',
                'AlAMAT',
                'JENIS KELAMIN',
                'TEMPAT LAHIR',
                'TANGGAL LAHIR',
                'KEWARGANEGARAAN',
                'AGAMA',
                'PEKERJAAN',
                'MAKSUD / TUJUAN',
                'TGL PENGAJUAN'
            ];
    }
}
