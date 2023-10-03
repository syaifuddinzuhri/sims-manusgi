<?php

namespace Database\Seeders;

use App\Constants\GlobalConstant;
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
            'name' => GlobalConstant::ADMIN,
            'is_lock' => 1
        ]);
        $admin->syncPermissions($arrPermission);

        Role::create([
            'name' => 'Kepala Sekolah',
            'is_lock' => 1
        ]);
        Role::create([
            'name' => 'Bendahara',
            'is_lock' => 1
        ]);
        Role::create([
            'name' => 'Wali Kelas',
            'is_lock' => 1
        ]);
        Role::create([
            'name' => 'Guru',
            'is_lock' => 1
        ]);
        Role::create([
            'name' => 'Siswa',
            'is_lock' => 1
        ]);
    }
}
