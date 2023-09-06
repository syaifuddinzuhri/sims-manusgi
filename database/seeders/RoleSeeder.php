<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
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

        Role::create([
            'name' => 'Super Admin'
        ]);
        Role::create([
            'name' => 'Kepala Sekolah'
        ]);
        Role::create([
            'name' => 'Bendahara'
        ]);
        Role::create([
            'name' => 'Guru'
        ]);
        Role::create([
            'name' => 'Siswa'
        ]);
    }
}
