<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allert extends Model
{
    protected $table ='allerts';

    protected $fillable = [
        'id_warga', 'id_rt', 'id_rw','id_kades','nama_warga','title','created_at', 'keterangan'
    ];

    public $timestamps = true;

}
