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
        User::where('username', 'administrator')->forceDelete();
        $role = Role::where('name', 'Administrator')->first();
        $user = User::create([
            'username' => 'administrator',
            'name' => 'Administrator',
            'password' => 'admin1234',
            'email' => 'administrator@gmail.com',
            'gender' => 'L'
        ]);
        $user->assignRole($role);
    }
}
