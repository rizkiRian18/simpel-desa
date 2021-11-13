<?php

namespace App\Exports;

use App\OrderSurat;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderSuratExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;


    public function collection()
    {
        return OrderSurat::where('rt_status' , "Di Setujui")->orderBy('rt', 'asc')->get([
            'nomor_urut_rt','sk_rw',  'nama', 'nik', 'nomor_kk','rt','alamat', 'jenis_kelamin','tempat_lahir', 'tanggal_lahir','agama','kewarganegaraan','pekerjaan', 'rt_status',
            'rw_status','maksud_surat','author','created_at'
        ]);
    }

    public function headings():array

    {
            return [
                'NOMOR URUT',
                'SK RW',
                'NAMA PEMOHON',
                'NIK',
                'NOMOR KK',
                'RT',
                'AlAMAT',
                'JENIS KELAMIN',
                'TEMPAT LAHIR',
                'TANGGAL LAHIR',
                'KEWARGANEGARAAN',
                'AGAMA',
                'PEKERJAAN',
                'STATUS SURAT (RT)',
                'STATUS SURAT (RW)',
                'MAKSUD / TUJUAN',
                'AUTHOR',
                'TGL PENGAJUAN'
            ];
    }


}
