<?php

namespace Database\Seeders;

use Carbon\Carbon;
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

        $master = Permission::create([
            'name' => 'read-master',
            'guard_name' => 'web',
            'label' => 'Data Master'
        ]);

        Permission::insert([
            ['name' => 'create-master-group', 'guard_name' => 'web', 'label' => 'Create Data Grup', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-master-group', 'guard_name' => 'web', 'label' => 'Read Data Grup', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-master-group', 'guard_name' => 'web', 'label' => 'Update Data Grup', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-master-group', 'guard_name' => 'web', 'label' => 'Delete Data Grup', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'create-master-staff', 'guard_name' => 'web', 'label' => 'Create Data Staff', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-master-staff', 'guard_name' => 'web', 'label' => 'Read Data Staff', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-master-staff', 'guard_name' => 'web', 'label' => 'Update Data Staff', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-master-staff', 'guard_name' => 'web', 'label' => 'Delete Data Staff', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'create-master-siswa', 'guard_name' => 'web', 'label' => 'Create Siswa', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-master-siswa', 'guard_name' => 'web', 'label' => 'Read Siswa', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-master-siswa', 'guard_name' => 'web', 'label' => 'Update Siswa', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-master-siswa', 'guard_name' => 'web', 'label' => 'Delete Siswa', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'create-master-tahun-ajaran', 'guard_name' => 'web', 'label' => 'Create Tahun Ajaran', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-master-tahun-ajaran', 'guard_name' => 'web', 'label' => 'Read Tahun Ajaran', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-master-tahun-ajaran', 'guard_name' => 'web', 'label' => 'Update Tahun Ajaran', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-master-tahun-ajaran', 'guard_name' => 'web', 'label' => 'Delete Tahun Ajaran', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'create-master-kelas', 'guard_name' => 'web', 'label' => 'Create Kelas', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-master-kelas', 'guard_name' => 'web', 'label' => 'Read Kelas', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-master-kelas', 'guard_name' => 'web', 'label' => 'Update Kelas', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-master-kelas', 'guard_name' => 'web', 'label' => 'Delete Kelas', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'create-master-jurusan', 'guard_name' => 'web', 'label' => 'Create Jurusan', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-master-jurusan', 'guard_name' => 'web', 'label' => 'Read Jurusan', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-master-jurusan', 'guard_name' => 'web', 'label' => 'Update Jurusan', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-master-jurusan', 'guard_name' => 'web', 'label' => 'Delete Jurusan', 'parent_id' => $master->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $transaksi_pembayaran = Permission::create([
            'name' => 'read-transaksi',
            'guard_name' => 'web',
            'label' => 'Transaksi Pembayaran'
        ]);
        Permission::insert([
            ['name' => 'create-transaksi-pembayaran', 'guard_name' => 'web', 'label' => 'Crate Data Pembayaran', 'parent_id' => $transaksi_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-transaksi-pembayaran', 'guard_name' => 'web', 'label' => 'Read Data Pembayaran', 'parent_id' => $transaksi_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-transaksi-pembayaran', 'guard_name' => 'web', 'label' => 'Update Data Pembayaran', 'parent_id' => $transaksi_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-transaksi-pembayaran', 'guard_name' => 'web', 'label' => 'Delete Data Pembayaran', 'parent_id' => $transaksi_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'create-transaksi-tunggakan', 'guard_name' => 'web', 'label' => 'Create Tunggakan Pembayaran', 'parent_id' => $transaksi_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-transaksi-tunggakan', 'guard_name' => 'web', 'label' => 'Read Tunggakan Pembayaran', 'parent_id' => $transaksi_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-transaksi-tunggakan', 'guard_name' => 'web', 'label' => 'Update Tunggakan Pembayaran', 'parent_id' => $transaksi_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-transaksi-tunggakan', 'guard_name' => 'web', 'label' => 'Delete Tunggakan Pembayaran', 'parent_id' => $transaksi_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $manajemen_pembayaran = Permission::create([
            'name' => 'read-pembayaran',
            'guard_name' => 'web',
            'label' => 'Manajemen Pembayaran'
        ]);
        Permission::insert([
            ['name' => 'create-pembayaran-pos', 'guard_name' => 'web', 'label' => 'Create POS Pembayaran', 'parent_id' => $manajemen_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-pembayaran-pos', 'guard_name' => 'web', 'label' => 'Read POS Pembayaran', 'parent_id' => $manajemen_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-pembayaran-pos', 'guard_name' => 'web', 'label' => 'Update POS Pembayaran', 'parent_id' => $manajemen_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-pembayaran-pos', 'guard_name' => 'web', 'label' => 'Delete POS Pembayaran', 'parent_id' => $manajemen_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'create-pembayaran-jenis', 'guard_name' => 'web', 'label' => 'Create Jenis Pembayaran', 'parent_id' => $manajemen_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-pembayaran-jenis', 'guard_name' => 'web', 'label' => 'Read Jenis Pembayaran', 'parent_id' => $manajemen_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-pembayaran-jenis', 'guard_name' => 'web', 'label' => 'Update Jenis Pembayaran', 'parent_id' => $manajemen_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-pembayaran-jenis', 'guard_name' => 'web', 'label' => 'Delete Jenis Pembayaran', 'parent_id' => $manajemen_pembayaran->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $jurnal = Permission::create([
            'name' => 'read-journal',
            'guard_name' => 'web',
            'label' => 'Jurnal Umum'
        ]);
        Permission::insert([
            ['name' => 'create-journal-kategori', 'guard_name' => 'web', 'label' => 'Create Kategori', 'parent_id' => $jurnal->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-journal-kategori', 'guard_name' => 'web', 'label' => 'Read Kategori', 'parent_id' => $jurnal->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-journal-kategori', 'guard_name' => 'web', 'label' => 'Update Kategori', 'parent_id' => $jurnal->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-journal-kategori', 'guard_name' => 'web', 'label' => 'Delete Kategori', 'parent_id' => $jurnal->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'create-journal-pemasukan', 'guard_name' => 'web', 'label' => 'Create Pemasukan', 'parent_id' => $jurnal->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-journal-pemasukan', 'guard_name' => 'web', 'label' => 'Read Pemasukan', 'parent_id' => $jurnal->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-journal-pemasukan', 'guard_name' => 'web', 'label' => 'Update Pemasukan', 'parent_id' => $jurnal->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-journal-pemasukan', 'guard_name' => 'web', 'label' => 'Delete Pemasukan', 'parent_id' => $jurnal->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'create-journal-pengeluaran', 'guard_name' => 'web', 'label' => 'Create Pengeluaran', 'parent_id' => $jurnal->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-journal-pengeluaran', 'guard_name' => 'web', 'label' => 'Read Pengeluaran', 'parent_id' => $jurnal->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-journal-pengeluaran', 'guard_name' => 'web', 'label' => 'Update Pengeluaran', 'parent_id' => $jurnal->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-journal-pengeluaran', 'guard_name' => 'web', 'label' => 'Delete Pengeluaran', 'parent_id' => $jurnal->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $manajemen_siswa = Permission::create([
            'name' => 'read-siswa',
            'guard_name' => 'web',
            'label' => 'Manajemen Siswa'
        ]);
        Permission::insert([
            ['name' => 'create-siswa-kenaikan', 'guard_name' => 'web', 'label' => 'Create Kenaikan Kelas', 'parent_id' => $manajemen_siswa->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-siswa-kenaikan', 'guard_name' => 'web', 'label' => 'Read Kenaikan Kelas', 'parent_id' => $manajemen_siswa->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-siswa-kenaikan', 'guard_name' => 'web', 'label' => 'Update Kenaikan Kelas', 'parent_id' => $manajemen_siswa->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-siswa-kenaikan', 'guard_name' => 'web', 'label' => 'Delete Kenaikan Kelas', 'parent_id' => $manajemen_siswa->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'create-siswa-kelulusan', 'guard_name' => 'web', 'label' => 'Create Kelulusan', 'parent_id' => $manajemen_siswa->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-siswa-kelulusan', 'guard_name' => 'web', 'label' => 'Read Kelulusan', 'parent_id' => $manajemen_siswa->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-siswa-kelulusan', 'guard_name' => 'web', 'label' => 'Update Kelulusan', 'parent_id' => $manajemen_siswa->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-siswa-kelulusan', 'guard_name' => 'web', 'label' => 'Delete Kelulusan', 'parent_id' => $manajemen_siswa->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'create-siswa-alumni', 'guard_name' => 'web', 'label' => 'Create Alumni', 'parent_id' => $manajemen_siswa->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-siswa-alumni', 'guard_name' => 'web', 'label' => 'Read Alumni', 'parent_id' => $manajemen_siswa->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-siswa-alumni', 'guard_name' => 'web', 'label' => 'Update Alumni', 'parent_id' => $manajemen_siswa->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'delete-siswa-alumni', 'guard_name' => 'web', 'label' => 'Delete Alumni', 'parent_id' => $manajemen_siswa->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $laporan = Permission::create([
            'name' => 'read-laporan',
            'guard_name' => 'web',
            'label' => 'Laporan'
        ]);
        Permission::insert([
            ['name' => 'read-laporan-transaksi', 'guard_name' => 'web', 'label' => 'Laporan Transaksi', 'parent_id' => $laporan->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-laporan-keuangan', 'guard_name' => 'web', 'label' => 'Laporan Keuangan', 'parent_id' => $laporan->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-laporan-bulanan', 'guard_name' => 'web', 'label' => 'Laporan Bulanan', 'parent_id' => $laporan->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-laporan-nonbulanan', 'guard_name' => 'web', 'label' => 'Laporan Non-Bulanan', 'parent_id' => $laporan->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $pengaturan = Permission::create([
            'name' => 'read-pengaturan',
            'guard_name' => 'web',
            'label' => 'Pengaturan'
        ]);
        Permission::insert([
            ['name' => 'read-pengaturan-umum', 'guard_name' => 'web', 'label' => 'Read Pengaturan Umum', 'parent_id' => $pengaturan->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-pengaturan-umum', 'guard_name' => 'web', 'label' => 'Update Pengaturan Umum', 'parent_id' => $pengaturan->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'read-pengaturan-aplikasi', 'guard_name' => 'web', 'label' => 'Read Aplikasi', 'parent_id' => $pengaturan->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'update-pengaturan-aplikasi', 'guard_name' => 'web', 'label' => 'Update Aplikasi', 'parent_id' => $pengaturan->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
