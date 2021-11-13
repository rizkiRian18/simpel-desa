<?php

namespace App\Exports;

use App\Warga;
use Maatwebsite\Excel\Concerns\FromCollection;

class KetuaRTExportWarga implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Warga::all();
    }
}
