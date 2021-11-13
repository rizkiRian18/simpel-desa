<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderSurat extends JsonResource
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
            'id_warga' =>$this->id_warga,
            'id_rt' => $this->id_rt,
            'id_rw' => $this->id_rw,
            'nik'  => $this->nik,
            'maksud_surat' => $this->maksud_surat,
            'nama' => $this->nama,
            'author' => $this-> author,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nomor_kk' => $this->nomor_kk,
            'kewarganegaraan' => $this->kewarganegaraan,
            'nomor_kk' => $this->nomor_kk,
            'pekerjaan' => $this->pekerjaan,
            'agama' => $this->agama,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'alamat' => $this->alamat,
            'sk_rt' => $this->sk_rt,
            'sk_rw' =>$this->sk_rw,
            'ttd_rt' =>$this->ttd_rt,
            'ttd_rw' =>$this->ttd_rw,
            'nomor_urut_rt' =>$this->nomor_urut_rt,
            'nomor_urut_rw' =>$this->nomor_urut_rw,
            'rt_status' =>$this->rt_status,
            'rw_status' =>$this->rw_status,
            'created_at' =>$this->created_at,
            'updated_at' => $this->updated_at,
        ];

    }
}
