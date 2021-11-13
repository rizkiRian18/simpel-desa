<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Warga extends Authenticatable implements JWTSubject
{

    use Notifiable;

    protected $table = "warga";

    public $timestamps = false;


    protected $fillable = [
     'id_rt','id_rw','id_kades', 'nama', 'nik', 'nomor_kk', 'email','rt','rw', 'email','jenis_kelamin','tempat_lahir','tanggal_lahir','agama','kewarganegaraan','pekerjaan'
      , 'alamat','password','usia', 'remember_token','lampiran_kk', 'lampiran_ktp'
    ];
    protected $hidden = [
        'password'
    ];

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

    public function ordersurat()
    {
        return $this->hasMany('App\OrderSurat');
    }

    public function rt()
    {

        return $this->belongsTo('App\Rt', 'id');
    }

}
