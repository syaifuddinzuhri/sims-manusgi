<?php

namespace App\Services;

use App\Models\User;

class KelulusanService
{

    public function store($payload)
    {
        try {
            if (!isset($payload['type'])) apiException('Tipe harus dipilih');
            if (!isset($payload['passed_year'])) apiException('Tahun lulus harus diisi');

            if ($payload['type'] == 'custom') {
                if (!isset($payload['student_form']) || count($payload['student_form']) == 0) apiException('Siswa harus dipilih');
                $user = User::where('is_student', 1)->whereIn('id', $payload['student_form'])->get();
            } else {
                if (!isset($payload['class_form'])) apiException('Kelas harus dipilih');
                $user = User::where('is_student', 1)->where('class_id', $payload['class_form'])->get();
            }
            foreach ($user as $key => $value) {
                $value->update([
                    'passed_year' => $payload['passed_year'],
                    'is_student' => 0,
                    'is_alumni' => 1,
                ]);
            }
            return true;
        } catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
