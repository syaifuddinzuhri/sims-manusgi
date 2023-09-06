<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'Super Admin')->first();
        $user = User::create([
            'username' => 'superadmin',
            'name' => 'Super Administrator',
            'password' => Hash::make('superadmin'),
            'email' => 'superadmin@gmail.com'
        ]);
        $user->assignRole($role);
    }
}
