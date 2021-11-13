<?php

namespace App\Exports;

use App\OrderSurat;
use Maatwebsite\Excel\Concerns\FromCollection;

class KetuaRTExportSurat implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return OrderSurat::all();
    }
}
