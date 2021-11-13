<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "rt";

    public function warga()
    {
        return $this->hasMany('App\Warga', 'id_rt');
    }
}
