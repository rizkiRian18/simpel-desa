<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RtResource extends JsonResource
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
            'id_rw' => $this->id_rw,
            'id_kades' => $this->id_kades,
            'id' => $this->id,
            'nama' => $this->nama,
            'nik' => $this->nik,
            'password' => $this->password,
            'rt' => $this->rt,
            'rw' => $this->rw,
        ];
    }
}
