<?php
/**
 * The manifest of files that are local to specific environment.
 * This file returns a list of environments that the application
 * may be installed under. The returned data must be in the following
 * format:
 *
 * ```php
 * return [
 *     'environment name' => [
 *         'path' => 'directory storing the local files',
 *         'skipFiles'  => [
 *             // list of files that should only copied once and skipped if they already exist
 *         ],
 *         'setWritable' => [
 *             // list of directories that should be set writable
 *         ],
 *         'setExecutable' => [
 *             // list of files that should be set executable
 *         ],
 *         'setCookieValidationKey' => [
 *             // list of config files that need to be inserted with automatically generated cookie validation keys
 *         ],
 *         'createSymlink' => [
 *             // list of symlinks to be created. Keys are symlinks, and values are the targets.
 *         ],
 *     ],
 * ];
 * ```
 */
return [
    'Development' => [
        'path' => 'dev',
        'setWritable' => [
            'admin/runtime',
            'admin/web/assets',
            'console/runtime',
            'akreditasi/runtime',
            'akreditasi/web/assets',
        ],
        'setExecutable' => [
            'yii',
            'yii_test',
        ],
        'setCookieValidationKey' => [
            'admin/config/main-local.php',
            'common/config/codeception-local.php',
            'akreditasi/config/main-local.php',
        ],
        'createSymlink' => [
            'admin/web/upload' => 'common/storages/upload',
            'akreditasi/web/upload' => 'common/storages/upload',
            'admin/web/media'=>'common/assets/metronic/assets/media',
            'akreditasi/web/media'=>'common/assets/metronic/assets/media'

        ]
    ],
    'Production' => [
        'path' => 'prod',
        'setWritable' => [
            'admin/runtime',
            'admin/web/assets',
            'console/runtime',
            'akreditasi/runtime',
            'akreditasi/web/assets',
        ],
        'setExecutable' => [
            'yii',
        ],
        'setCookieValidationKey' => [
            'admin/config/main-local.php',
            'akreditasi/config/main-local.php',
        ],
        'createSymlink' => [
            'admin/web/upload' => 'common/storages/upload',
            'akreditasi/web/upload' => 'common/storages/upload',
            'admin/web/media'=>'common/assets/metronic/assets/media',
            'akreditasi/web/media'=>'common/assets/metronic/assets/media'

        ]
    ],

];
