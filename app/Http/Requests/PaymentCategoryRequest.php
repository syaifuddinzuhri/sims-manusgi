<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'payment_type_id' => 'required',
            'academic_year_id' => 'required',
            'type' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'payment_type_id.required' => 'Pos pembayaran harus diisi',
            'academic_year_id.required' => 'Tahun ajaran harus diisi',
            'type.required' => 'Tipe harus diisi',
        ];
    }
}
