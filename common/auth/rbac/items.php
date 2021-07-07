<?php
return [
    'superadmin' => [
        'type' => 1,
        'children' => [
            '@app-admin/*',
            '@app-akreditasi/*',
            '@app-monitoring/*',
        ],
    ],
    'admin' => [
        'type' => 1,
    ],
    'lpm' => [
        'type' => 1,
    ],
    'rektorat' => [
        'type' => 1,
    ],
    'unit' => [
        'type' => 1,
    ],
    'fakultas' => [
        'type' => 1,
    ],
    'dekanat' => [
        'type' => 1,
    ],
    'prodi' => [
        'type' => 1,
    ],
    'kaprodi' => [
        'type' => 1,
    ],
    '@app-admin/*' => [
        'type' => 2,
    ],
    '@app-akreditasi/*' => [
        'type' => 2,
    ],
    '@app-monitoring/*' => [
        'type' => 2,
    ],
];
