<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JournalRequest extends FormRequest
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
            'name' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'journal_category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'date.required' => 'Tanggal harus diisi',
            'amount.required' => 'Jumlah harus diisi',
            'journal_category_id.required' => 'Kategori harus diisi'
        ];
    }
}
