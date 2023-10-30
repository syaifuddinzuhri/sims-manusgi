<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::create([
            'name' => 'Wisuda',
            'notes' => 'Wisuda',
        ]);
        PaymentType::create([
            'name' => 'SPP',
            'notes' => 'SPP',
        ]);
    }
}