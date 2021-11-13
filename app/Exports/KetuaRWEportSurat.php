<?php

namespace App\Exports;

use App\OrderSurat;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class KetuaRWEportSurat implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {

        return  OrderSurat::where('id_rw', $this->id)
        ->where('rt_status', 'Di Setujui')
        ->get([
            'sk_rt', 'sk_rw', 'nama', 'nik', 'nomor_kk','alamat', 'rt','rw','jenis_kelamin','tempat_lahir', 'tanggal_lahir','agama','kewarganegaraan','pekerjaan','maksud_surat','author','created_at'
        ]);
    }

    public function headings():array

    {
            return [
                'SK_RT',
                'SK RW',
                'NAMA PEMOHON',
                'NIK',
                'NOMOR KK',
                'AlAMAT',
                'RT',
                'RW',
                'JENIS KELAMIN',
                'TEMPAT LAHIR',
                'TANGGAL LAHIR',
                'AGAMA',
                'KEWARGANEGARAAN',
                'PEKERJAAN',
                'MAKSUD / TUJUAN',
                'AUTHOR',
                'TGL PENGAJUAN'
            ];
    }
}
