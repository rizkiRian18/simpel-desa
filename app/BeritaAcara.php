<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    protected $table = "berita_acara";

    protected $fillable = [
            'id_warga', 'id_rt', 'id_rw', 'id_kades','judul_berita', 'keterangan_berita', 'lampiran_berita', 'created_at', 'updated_at'
    ];

    public $timestamps = true;


}
