<?php

$masterMenu =  [
    'name' => 'Data Master',
    'permission' => 'master',
    'route_prefix' => 'master',
    'route_name' => '',
    'icon' => 'fas fa-list-check',
    'sub_menus' => [
        [
            'name' => 'Data Group',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Data Staff',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Data Siswa',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Tahun Ajaran',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Kelas',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
    ]
];

$manajemenSiswaMenu =  [
    'name' => 'Manajemen Siswa',
    'permission' => '',
    'route_prefix' => '',
    'route_name' => '',
    'icon' => 'fas fa-list-check',
    'sub_menus' => [
        [
            'name' => 'Kenaikan Kelas',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Kelulusan',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Alumni',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
    ]
];

$journalMenu =  [
    'name' => 'Jurnal Umum',
    'permission' => '',
    'route_prefix' => '',
    'route_name' => '',
    'icon' => 'fas fa-list-check',
    'sub_menus' => [
        [
            'name' => 'Kategori',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Pemasukan',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Pengeluaran',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
    ]
];

$reportMenu =  [
    'name' => 'Laporan',
    'permission' => '',
    'route_prefix' => '',
    'route_name' => '',
    'icon' => 'fas fa-list-check',
    'sub_menus' => [
        [
            'name' => 'Laporan Transaksi',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Laporan Keuangan',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Pembayaran Bulanan',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Pembayaran Non-Bulanan',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
    ]
];

$manajemenPembayaranMenu =  [
    'name' => 'Manajemen Pembayaran',
    'permission' => '',
    'route_prefix' => '',
    'route_name' => '',
    'icon' => 'fas fa-list-check',
    'sub_menus' => [
        [
            'name' => 'POS Pembayaran',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Jenis Pembayaran',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
    ]
];

$transaksiMenu = [
    'name' => 'Transaksi Pembayaran',
    'permission' => '',
    'route_prefix' => '',
    'route_name' => '',
    'icon' => 'fas fa-list-check',
    'sub_menus' => [
        [
            'name' => 'Data Pembayaran',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Tunggakan Pembayaran',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
    ]
];

$settingMenu = [
    'name' => 'Pengaturan',
    'permission' => '',
    'route_prefix' => '',
    'route_name' => '',
    'icon' => 'fas fa-list-check',
    'sub_menus' => [
        [
            'name' => 'Umum',
            'permission' => '',
            'route_prefix' => '',
            'route_name' => '',
        ],
        [
            'name' => 'Aplikasi & Backup',
            'permission' => '',
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
