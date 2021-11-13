<?php

namespace App\Exports;

use App\Warga;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class WargaAllExport implements FromCollection,WithHeadings, WithDrawings, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Warga::orderBy('rt', 'asc')
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

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This RT 3');
        $drawing->setPath(public_path('/Asset 4-8.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B3');

        return $drawing;
    }


    public function startCell(): string
    {
        return 'A10';
    }
}
