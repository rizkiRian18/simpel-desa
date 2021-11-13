<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Warga extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [


            'id' => $this->id,
            'id_rt' =>$this->id_rt,
            'nama' => $this->nama,
            'nik' => $this->nik,
            'nomor_kk' => $this->nomor_kk,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'email' =>$this->email,
            'kewarganegaraan' => $this->kewarganegaraan,
            'agama' => $this->agama,
            'pekerjaan'=> $this->pekerjaan,
            'password' => $this->password,
            'alamat' => $this->alamat,

        ];
    }

}
