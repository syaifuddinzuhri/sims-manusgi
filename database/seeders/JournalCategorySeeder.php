<?php

namespace Database\Seeders;

use App\Models\JournalCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JournalCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JournalCategory::create([
            'name' => 'Pembayaran Siswa',
            'type' => 'in',
            'notes' => 'Semua pemasukan yang diperoleh dari iuran bulanan/non bulanan siswa',
            'is_lock' => 1
        ]);
    }
}
