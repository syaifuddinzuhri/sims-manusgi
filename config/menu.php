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
    'route_prefix' => '',
    'route_name' => '',
    'icon' => 'fas fa-users',
    'sub_menus' => [
        [
            'name' => 'Kenaikan Kelas',
            'permission' => 'read-siswa-kenaikan',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Kelulusan',
            'permission' => 'read-siswa-kelulusan',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Alumni',
            'permission' => 'read-siswa-alumni',
            'route_prefix' => '',
            'route_name' => '',
        ],
    ]
];

$journalMenu =  [
    'name' => 'Jurnal Umum',
    'permission' => 'read-journal',
    'route_prefix' => '',
    'route_name' => '',
    'icon' => 'fas fa-book',
    'sub_menus' => [
        [
            'name' => 'Kategori',
            'permission' => 'read-journal-kategori',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Pemasukan',
            'permission' => 'read-journal-pemasukan',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Pengeluaran',
            'permission' => 'read-journal-pengeluaran',
            'route_prefix' => '',
            'route_name' => '',
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
    'route_prefix' => '',
    'route_name' => '',
    'icon' => 'fas fa-wallet',
    'sub_menus' => [
        [
            'name' => 'POS Pembayaran',
            'permission' => 'read-pembayaran-pos',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Jenis Pembayaran',
            'permission' => 'read-pembayaran-jenis',
            'route_prefix' => '',
            'route_name' => '',
        ],
    ]
];

$transaksiMenu = [
    'name' => 'Transaksi Pembayaran',
    'permission' => 'read-transaksi',
    'route_prefix' => '',
    'route_name' => '',
    'icon' => 'fas fa-money-bill-transfer',
    'sub_menus' => [
        [
            'name' => 'Data Pembayaran',
            'permission' => 'read-transaksi-pembayaran',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Tunggakan Pembayaran',
            'permission' => 'read-transaksi-tunggakan',
            'route_prefix' => '',
            'route_name' => '',
        ],
    ]
];

$settingMenu = [
    'name' => 'Pengaturan',
    'permission' => 'read-pengaturan',
    'route_prefix' => '',
    'route_name' => '',
    'icon' => 'fas fa-gear',
    'sub_menus' => [
        [
            'name' => 'Umum',
            'permission' => 'read-pengaturan-umum',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Aplikasi & Backup',
            'permission' => 'read-pengaturan-aplikasi',
            'route_prefix' => '',
            'route_name' => '',
        ],
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
