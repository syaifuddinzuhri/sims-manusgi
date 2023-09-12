<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            $rules['name'] = ['required', Rule::unique('roles')->whereNull('deleted_at')];
        } else {
            $id = decryptData($this->route()->staff);
            $rules['name'] = ['required', Rule::unique('roles')->ignore($id, 'id')->whereNull('deleted_at')];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'name.unique' => 'Nama sudah ada',
        ];
    }
}
