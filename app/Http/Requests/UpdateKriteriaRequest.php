<?php

namespace App\Http\Requests;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateKriteriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'kode' => ['required', 'string', 'max:255', Rule::unique('kriterias')->ignore($this->kriteria)],
            'kode' => ['required', 'string', 'max:255', Rule::unique('kriterias')->ignore($this->kriteria)],
        ];
    }

    public function messages()
    {
        return [
            Toastr::error('Kriteria Gagal Diubah', 'Error', ["positionClass" => "toast-top-right"])
        ];
    }
}
