<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderSuratRequest extends FormRequest
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
            
            'nik'  => 'required',
            'maksud_surat' => "required",
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'nomor_kk' => 'required',
            'kewarganegaraan' => 'required',
            'pekerjaan' => "required",
            'agama' => "required",
            'rt' => "required",
            'rw' => "required",
            'alamat' => "required",
        ];
    }
}
