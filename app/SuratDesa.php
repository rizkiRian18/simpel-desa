<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratDesa extends Model
{
    protected $table = "surat_desa";


    protected $fillable = [
       'id_surat_rt_rw', 'lampiran_satu', 'lampiran_dua', 'lampiran_tiga', 'lampiran_empat', 'lampiran_lima'
    ];
}
