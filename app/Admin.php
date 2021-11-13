<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Admin extends Authenticatable
{
    
    use Notifiable;

    
    protected $table = "admin";

    protected $fillable = [
        'name', 'email', 'password','pesan'
    ];

    public $timestamps = false;
    
    protected $hidden = [
        'password', 'remmber_token'
    ];


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

  

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
   
}
