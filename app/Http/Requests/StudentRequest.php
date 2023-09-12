<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'gender' => 'required',
            'class_id' => 'required',
        ];

        if ($this->isMethod('POST')) {
            $rules['username'] = ['required', Rule::unique('users')->whereNull('deleted_at')];
            $rules['password'] = 'required|confirmed|min:6';
        } else {
            $id = decryptData($this->route()->siswa);
            $rules['username'] = ['required', Rule::unique('users')->ignore($id, 'id')->whereNull('deleted_at')];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah ada',
            'gender.required' => 'Jenis kelamin harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sama',
            'class_id.required' => 'Kelas harus diisi',
        ];
    }
}
