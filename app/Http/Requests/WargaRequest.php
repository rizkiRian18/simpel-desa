<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WargaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_rt' => 'required',
            'id_rw' =>'required',
            'id_kades' => 'required',
            'nama' => 'required',
            'nik' => 'required',
            'nomor_kk' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kewarganegaraan' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'password' => 'required',
            'alamat'=> 'required',
            // 'lampiran_kk' => 'required',

        ];
    }
}
