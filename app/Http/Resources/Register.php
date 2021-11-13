<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rules\Unique;

class Register extends JsonResource
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
            'nama' => $this->nama,
            'nik' => $this->nik,
            'password' => $this->password,
            
        ];
    }
}
