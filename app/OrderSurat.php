<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OrderSurat extends Authenticatable implements JWTSubject
{

    use Notifiable;

    protected $table = "order_surat";


    protected $fillable = [
       'id_warga', 'id_rt', 'id_rw', 'nama','author', 'nik' , 'tempat_lahir', 'tanggal_lahir','jenis_kelamin' , 'nomor_kk', 'kewarganegaraan', 'pekerjaan','agama' ,'rt', 'rw', 'alamat','maksud_surat', 'ttd_rt', 'ttd_rw', 'nomor_urut_rt', 'nomor_urut_rw', 'rt_status','rw_status'
        ,'created_at','feedback_rt', 'feedback_rw','feedback_kades','kades_status','validasi_kades','tambah_lampiran','lampiran_satu', 'file_kades','lampiran_dua', 'lampiran_tiga','lampiran_empat','lampiran_lima','lampiran_enam','lampiran_tujuh'


    ];


    // public $dateFormat = 'Y-m-d';
    public $timestamps = false;
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function order_surat(){
        return $this->belongsTo('App\Warga');
    }
}
