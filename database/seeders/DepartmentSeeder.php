<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Department::truncate();
        Classes::truncate();

        $iis = Department::create([
            'name' => 'IIS'
        ]);
        $ibb = Department::create([
            'name' => 'IBB'
        ]);
        $mia = Department::create([
            'name' => 'MIA'
        ]);

        Classes::create([
            'department_id' => $iis->id,
            'name' => 'X'
        ]);

        Classes::create([
            'department_id' => $iis->id,
            'name' => 'XI'
        ]);

        Classes::create([
            'department_id' => $iis->id,
            'name' => 'XII'
        ]);

        Classes::create([
            'department_id' => $ibb->id,
            'name' => 'X'
        ]);

        Classes::create([
            'department_id' => $ibb->id,
            'name' => 'XI'
        ]);

        Classes::create([
            'department_id' => $ibb->id,
            'name' => 'XII'
        ]);

        Classes::create([
            'department_id' => $mia->id,
            'name' => 'X'
        ]);

        Classes::create([
            'department_id' => $mia->id,
            'name' => 'XI'
        ]);

        Classes::create([
            'department_id' => $mia->id,
            'name' => 'XII'
        ]);
    }
}
