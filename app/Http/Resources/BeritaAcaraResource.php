<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BeritaAcaraResource extends JsonResource
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
            'judul_berita' => $this->judul_berita,
            'keterangan_berita' => $this->keterangan_berita,
            'lampiran_berita' => $this->keterangan_berita,
            // 'created_at' => \Carbon\Carbon::createFromFormat('m/d/Y', $this->created_at)->format('Y-m-d');

        ];
    }
}
