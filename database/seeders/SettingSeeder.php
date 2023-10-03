<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'app_name' => 'SIMS',
            'app_footer' => 'MA NU Sunan Giri',
            'school_name' => 'MA NU Sunan Giri',
        ]);
    }
}
