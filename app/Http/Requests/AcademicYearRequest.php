<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcademicYearRequest extends FormRequest
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
            'semester' => 'required',
            'first_year' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'semester.required' => 'Semester harus diisi',
            'first_year.required' => 'Tahun awal harus diisi',
        ];
    }
}
