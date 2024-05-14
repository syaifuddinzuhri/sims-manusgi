<?php

namespace App\Imports;

use App\Constants\GlobalConstant;
use App\Models\Classes;
use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Spatie\Permission\Models\Role;

class StudentImport implements ToCollection, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            $role = Role::where('name', GlobalConstant::ROLE_STUDENT)->first();
            foreach ($collection as $key => $row) {
                $exist = User::where('username', $row[1])->first();
                if (!$exist) {
                    $class = $row[5];
                    $department = $row[6];
                    $departmentData = Department::where('name', $department)->first();

                    $class_id = NULL;
                    if ($departmentData) {
                        $classData = Classes::where('name', $class)->where('department_id', $departmentData->id)->first();
                        $class_id = $classData ? $classData->id : NULL;
                    }

                    $user = User::create([
                        'nisn' => $row[0],
                        'username' => $row[1],
                        'name' => $row[2],
                        'email' => $row[3],
                        'password' => $row[4],
                        'password_encrypted' => $row[4],
                        'gender' => $row[7],
                        'class_id' => $class_id,
                        'is_student' => 1
                    ]);
                    $user->assignRole($role);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            throw new Exception("Server Error: Pastikan format data sudah sesuai.");
        }
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
