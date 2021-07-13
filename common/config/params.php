<?php
$ini = parse_ini_file(__DIR__ . '/../../system-configuration.ini');

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    'institusi' => $ini['institusi'],
    'nama_sistem' => $ini['nama_sistem'],
    'url_institusi' => $ini['url_institusi'],
    'author' => $ini['author'],
    'url_author' => $ini['url_author'],
    'bsVersion' => '4.x', // this will set globally `bsVersion` to Bootstrap 4.x for all Krajee Extensions
    'mdm.admin.configs' => [
        'advanced' => [
            'dashboard-admin' => [
                '@common/config/main.php',
                '@common/config/main-local.php',
                '@admin/config/main.php',
                '@admin/config/main-local.php',
            ],
            'dashboard-akreditasi' => [
                '@common/config/main.php',
                '@common/config/main-local.php',
                '@akreditasi/config/main.php',
                '@akreditasi/config/main-local.php',
            ],
        ],
    ],

    'uploadPath' => '{lembaga}/{jenis_akreditasi}/{tahun}/{level}/{id}',
];
