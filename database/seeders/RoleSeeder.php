<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();

        $permission = Permission::get();
        $arrPermission = [];
        foreach ($permission as $key => $value) {
            array_push($arrPermission, $value->name);
        }

        $admin = Role::create([
            'name' => 'Administrator'
        ]);
        $admin->syncPermissions($arrPermission);

        Role::create([
            'name' => 'Kepala Sekolah'
        ]);
        Role::create([
            'name' => 'Bendahara'
        ]);
        Role::create([
            'name' => 'Wali Kelas'
        ]);
        Role::create([
            'name' => 'Guru'
        ]);
        Role::create([
            'name' => 'Siswa'
        ]);
    }
}
