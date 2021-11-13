<?php

namespace App\Exports;

use App\Warga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KetuaRWExportWarga implements FromCollection, WithHeadings
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
        return  Warga::where('id_rw', $this->id)

        ->get([
            'nama', 'nik', 'nomor_kk', 'alamat', 'rt','rw','jabatan','jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'kewarganegaraan', 'agama', 'pekerjaan', 'created_at'
        ]);
    }

    public function headings():array

    {
        return [
            'NAMA',
            'NIK',
            'NOMOR KK',
            'AlAMAT',
            'RT',
            'RW',
            'JABATAN',
            'JENIS KELAMIN',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'RT',
            'RW',
            'KEWARGANEGARAAN',
            'AGAMA',
            'PEKERJAAN',
            'TGL PENDAFTARAN'
        ];
    }
}
