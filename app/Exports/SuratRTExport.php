<?php

namespace App\Exports;

use App\OrderSurat;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SuratRTExport implements FromCollection, WithHeadings
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
        return OrderSurat::where('id_rt', $this->id)->get([
            'nomor_urut_rt','sk_rt',  'nama', 'nik', 'nomor_kk','alamat', 'jenis_kelamin','tempat_lahir', 'tanggal_lahir','agama','kewarganegaraan','pekerjaan', 'rt_status','maksud_surat','author','created_at'
        ]);
    }

    public function headings():array

    {
            return [
                'NOMOR URUT',
                'SK RT',
                'NAMA PEMOHON',
                'NIK',
                'NOMOR KK',
                'AlAMAT',
                'JENIS KELAMIN',
                'TEMPAT LAHIR',
                'TANGGAL LAHIR',
                'KEWARGANEGARAAN',
                'AGAMA',
                'PEKERJAAN',
                'STATUS SURAT',
                'MAKSUD / TUJUAN',
                'AUTHOR',
                'TGL PENGAJUAN'
            ];
    }
}
