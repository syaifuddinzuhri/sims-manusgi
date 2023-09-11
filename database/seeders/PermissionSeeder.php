<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Permission::insert([
            ['name' => 'read-master', 'guard_name' => 'web'],
            ['name' => 'create-master-group', 'guard_name' => 'web'],
            ['name' => 'read-master-group', 'guard_name' => 'web'],
            ['name' => 'update-master-group', 'guard_name' => 'web'],
            ['name' => 'delete-master-group', 'guard_name' => 'web'],
            ['name' => 'create-master-staff', 'guard_name' => 'web'],
            ['name' => 'read-master-staff', 'guard_name' => 'web'],
            ['name' => 'update-master-staff', 'guard_name' => 'web'],
            ['name' => 'delete-master-staff', 'guard_name' => 'web'],
            ['name' => 'create-master-siswa', 'guard_name' => 'web'],
            ['name' => 'read-master-siswa', 'guard_name' => 'web'],
            ['name' => 'update-master-siswa', 'guard_name' => 'web'],
            ['name' => 'delete-master-siswa', 'guard_name' => 'web'],
            ['name' => 'create-master-tahun-ajaran', 'guard_name' => 'web'],
            ['name' => 'read-master-tahun-ajaran', 'guard_name' => 'web'],
            ['name' => 'update-master-tahun-ajaran', 'guard_name' => 'web'],
            ['name' => 'delete-master-tahun-ajaran', 'guard_name' => 'web'],
            ['name' => 'create-master-kelas', 'guard_name' => 'web'],
            ['name' => 'read-master-kelas', 'guard_name' => 'web'],
            ['name' => 'update-master-kelas', 'guard_name' => 'web'],
            ['name' => 'delete-master-kelas', 'guard_name' => 'web'],
            ['name' => 'create-master-jurusan', 'guard_name' => 'web'],
            ['name' => 'read-master-jurusan', 'guard_name' => 'web'],
            ['name' => 'update-master-jurusan', 'guard_name' => 'web'],
            ['name' => 'delete-master-jurusan', 'guard_name' => 'web'],
            ['name' => 'read-transaksi', 'guard_name' => 'web'],
            ['name' => 'create-transaksi-pembayaran', 'guard_name' => 'web'],
            ['name' => 'read-transaksi-pembayaran', 'guard_name' => 'web'],
            ['name' => 'update-transaksi-pembayaran', 'guard_name' => 'web'],
            ['name' => 'delete-transaksi-pembayaran', 'guard_name' => 'web'],
            ['name' => 'create-transaksi-tunggakan', 'guard_name' => 'web'],
            ['name' => 'read-transaksi-tunggakan', 'guard_name' => 'web'],
            ['name' => 'update-transaksi-tunggakan', 'guard_name' => 'web'],
            ['name' => 'delete-transaksi-tunggakan', 'guard_name' => 'web'],
            ['name' => 'read-pembayaran', 'guard_name' => 'web'],
            ['name' => 'create-pembayaran-pos', 'guard_name' => 'web'],
            ['name' => 'read-pembayaran-pos', 'guard_name' => 'web'],
            ['name' => 'update-pembayaran-pos', 'guard_name' => 'web'],
            ['name' => 'delete-pembayaran-pos', 'guard_name' => 'web'],
            ['name' => 'create-pembayaran-jenis', 'guard_name' => 'web'],
            ['name' => 'read-pembayaran-jenis', 'guard_name' => 'web'],
            ['name' => 'update-pembayaran-jenis', 'guard_name' => 'web'],
            ['name' => 'delete-pembayaran-jenis', 'guard_name' => 'web'],
            ['name' => 'read-journal', 'guard_name' => 'web'],
            ['name' => 'create-journal-kategori', 'guard_name' => 'web'],
            ['name' => 'read-journal-kategori', 'guard_name' => 'web'],
            ['name' => 'update-journal-kategori', 'guard_name' => 'web'],
            ['name' => 'delete-journal-kategori', 'guard_name' => 'web'],
            ['name' => 'create-journal-pemasukan', 'guard_name' => 'web'],
            ['name' => 'read-journal-pemasukan', 'guard_name' => 'web'],
            ['name' => 'update-journal-pemasukan', 'guard_name' => 'web'],
            ['name' => 'delete-journal-pemasukan', 'guard_name' => 'web'],
            ['name' => 'create-journal-pengeluaran', 'guard_name' => 'web'],
            ['name' => 'read-journal-pengeluaran', 'guard_name' => 'web'],
            ['name' => 'update-journal-pengeluaran', 'guard_name' => 'web'],
            ['name' => 'delete-journal-pengeluaran', 'guard_name' => 'web'],
            ['name' => 'read-siswa', 'guard_name' => 'web'],
            ['name' => 'create-siswa-kenaikan', 'guard_name' => 'web'],
            ['name' => 'read-siswa-kenaikan', 'guard_name' => 'web'],
            ['name' => 'update-siswa-kenaikan', 'guard_name' => 'web'],
            ['name' => 'delete-siswa-kenaikan', 'guard_name' => 'web'],
            ['name' => 'create-siswa-kelulusan', 'guard_name' => 'web'],
            ['name' => 'read-siswa-kelulusan', 'guard_name' => 'web'],
            ['name' => 'update-siswa-kelulusan', 'guard_name' => 'web'],
            ['name' => 'delete-siswa-kelulusan', 'guard_name' => 'web'],
            ['name' => 'create-siswa-alumni', 'guard_name' => 'web'],
            ['name' => 'read-siswa-alumni', 'guard_name' => 'web'],
            ['name' => 'update-siswa-alumni', 'guard_name' => 'web'],
            ['name' => 'delete-siswa-alumni', 'guard_name' => 'web'],
            ['name' => 'read-laporan', 'guard_name' => 'web'],
            ['name' => 'read-laporan-transaksi', 'guard_name' => 'web'],
            ['name' => 'read-laporan-keuangan', 'guard_name' => 'web'],
            ['name' => 'read-laporan-bulanan', 'guard_name' => 'web'],
            ['name' => 'read-laporan-nonbulanan', 'guard_name' => 'web'],
            ['name' => 'read-pengaturan', 'guard_name' => 'web'],
            ['name' => 'create-pengaturan-umum', 'guard_name' => 'web'],
            ['name' => 'read-pengaturan-umum', 'guard_name' => 'web'],
            ['name' => 'update-pengaturan-umum', 'guard_name' => 'web'],
            ['name' => 'create-pengaturan-aplikasi', 'guard_name' => 'web'],
            ['name' => 'read-pengaturan-aplikasi', 'guard_name' => 'web'],
            ['name' => 'update-pengaturan-aplikasi', 'guard_name' => 'web'],
        ]);
    }
}
