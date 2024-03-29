<?php

$masterMenu =  [
    'name' => 'Data Master',
    'permission' => 'read-master',
    'route_prefix' => 'master',
    'route_name' => '',
    'icon' => 'fas fa-list-check',
    'sub_menus' => [
        [
            'name' => 'Data Grup',
            'permission' => 'read-master-group',
            'route_prefix' => 'grup',
            'route_name' => 'grup.index',
        ],
        [
            'name' => 'Data Staff',
            'permission' => 'read-master-staff',
            'route_prefix' => 'staff',
            'route_name' => 'staff.index',
        ],
        [
            'name' => 'Data Siswa',
            'permission' => 'read-master-siswa',
            'route_prefix' => 'siswa',
            'route_name' => 'siswa.index',
        ],
        [
            'name' => 'Tahun Ajaran',
            'permission' => 'read-master-tahun-ajaran',
            'route_prefix' => 'tahun-ajaran',
            'route_name' => 'tahun-ajaran.index',
        ],
        [
            'name' => 'Jurusan',
            'permission' => 'read-master-jurusan',
            'route_prefix' => 'jurusan',
            'route_name' => 'jurusan.index',
        ],
        [
            'name' => 'Kelas',
            'permission' => 'read-master-kelas',
            'route_prefix' => 'kelas',
            'route_name' => 'kelas.index',
        ],
    ]
];

$manajemenSiswaMenu =  [
    'name' => 'Manajemen Siswa',
    'permission' => 'read-siswa',
    'route_prefix' => 'manajemen-siswa',
    'route_name' => '',
    'icon' => 'fas fa-users',
    'sub_menus' => [
        [
            'name' => 'Kenaikan Kelas',
            'permission' => 'read-siswa-kenaikan',
            'route_prefix' => 'kenaikan-kelas',
            'route_name' => 'kenaikan-kelas.index',
        ],
        [
            'name' => 'Kelulusan',
            'permission' => 'read-siswa-kelulusan',
            'route_prefix' => 'kelulusan',
            'route_name' => 'kelulusan.index',
        ],
        [
            'name' => 'Alumni',
            'permission' => 'read-siswa-alumni',
            'route_prefix' => 'alumni',
            'route_name' => 'alumni.index',
        ],
    ]
];

$journalMenu =  [
    'name' => 'Jurnal Umum',
    'permission' => 'read-journal',
    'route_prefix' => 'jurnal',
    'route_name' => '',
    'icon' => 'fas fa-book',
    'sub_menus' => [
        [
            'name' => 'Kategori',
            'permission' => 'read-journal-kategori',
            'route_prefix' => 'kategori',
            'route_name' => 'kategori.index',
        ],
        [
            'name' => 'Pemasukan',
            'permission' => 'read-journal-pemasukan',
            'route_prefix' => 'pemasukan',
            'route_name' => 'pemasukan.index',
        ],
        [
            'name' => 'Pengeluaran',
            'permission' => 'read-journal-pengeluaran',
            'route_prefix' => 'pengeluaran',
            'route_name' => 'pengeluaran.index',
        ],
    ]
];

$reportMenu =  [
    'name' => 'Laporan',
    'permission' => 'read-laporan',
    'route_prefix' => '',
    'route_name' => '',
    'icon' => 'fas fa-chart-simple',
    'sub_menus' => [
        [
            'name' => 'Laporan Transaksi',
            'permission' => 'read-laporan-transaksi',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Laporan Keuangan',
            'permission' => 'read-laporan-keuangan',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Pembayaran Bulanan',
            'permission' => 'read-laporan-bulanan',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Pembayaran Non-Bulanan',
            'permission' => 'read-laporan-nonbulanan',
            'route_prefix' => '',
            'route_name' => '',
        ],
    ]
];

$manajemenPembayaranMenu =  [
    'name' => 'Manajemen Pembayaran',
    'permission' => 'read-pembayaran',
    'route_prefix' => 'manajemen-pembayaran',
    'route_name' => '',
    'icon' => 'fas fa-wallet',
    'sub_menus' => [
        [
            'name' => 'POS Pembayaran',
            'permission' => 'read-pembayaran-pos',
            'route_prefix' => 'tipe',
            'route_name' => 'tipe.index',
        ],
        [
            'name' => 'Jenis Pembayaran',
            'permission' => 'read-pembayaran-jenis',
            'route_prefix' => 'jenis',
            'route_name' => 'jenis.index',
        ],
    ]
];

$transaksiMenu = [
    'name' => 'Transaksi Pembayaran',
    'permission' => 'read-transaksi',
    'route_prefix' => 'transaksi',
    'route_name' => '',
    'icon' => 'fas fa-money-bill-transfer',
    'sub_menus' => [
        [
            'name' => 'Tunggakan Pembayaran',
            'permission' => 'read-transaksi-tunggakan',
            'route_prefix' => 'tunggakan',
            'route_name' => 'tunggakan.index',
        ],
        [
            'name' => 'Data Pembayaran',
            'permission' => 'read-transaksi-pembayaran',
            'route_prefix' => 'pembayaran',
            'route_name' => 'pembayaran.index',
        ],
    ]
];

$settingMenu = [
    'name' => 'Pengaturan',
    'permission' => 'read-pengaturan',
    'route_prefix' => 'pengaturan',
    'route_name' => '',
    'icon' => 'fas fa-gear',
    'sub_menus' => [
        [
            'name' => 'Umum',
            'permission' => 'read-pengaturan-umum',
            'route_prefix' => 'umum',
            'route_name' => 'umum.index',
        ],
        // [
        //     'name' => 'Aplikasi & Backup',
        //     'permission' => 'read-pengaturan-aplikasi',
        //     'route_prefix' => '',
        //     'route_name' => '',
        // ],
    ]
];


return [
    'menus' => [
        $masterMenu,
        $transaksiMenu,
        $manajemenPembayaranMenu,
        $journalMenu,
        $manajemenSiswaMenu,
        $reportMenu,
        $settingMenu
    ]
];
