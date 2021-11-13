<?php

namespace App\Exports;

use App\Warga;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeading;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class WargaExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;




   public function __construct( $id){
        $this->id = $id;
    }
    
    public function collection()
    {
        return Warga::where('id_rt', $this->id)->get([
            'nama', 'nik', 'nomor_kk', 'alamat', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'kewarganegaraan', 'agama', 'pekerjaan', 'created_at'
        ]);
    }

    public function headings():array

    {
            return [
                'NAMA',
                'NIK',
                'NOMOR KK',
                'AlAMAT',
                'JENIS KELAMIN',
                'TEMPAT LAHIR',
                'TANGGAL LAHIR',
                'KEWARGANEGARAAN',
                'AGAMA',
                'PEKERJAAN',
                'TGL PENDAFTARAN'
            ];
    }
}
