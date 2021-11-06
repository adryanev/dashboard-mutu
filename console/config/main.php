<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'queue', 'autocomplete'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationNamespaces' => [
                //...
                'zhuravljov\yii\queue\monitor\migrations',

            ],
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'autocomplete' => [
            'class' => 'iiifx\Yii2\Autocomplete\Component',
            'config' => [
                '@common/config/main.php',
                '@common/config/main-local.php',
                '@akreditasi/config/main.php',
                '@akreditasi/config/main-local.php',
                '@admin/config/main.php',
                '@admin/config/main-local.php',
                '@console/config/main.php',
                '@console/config/main-local.php',
            ],
        ],
    ],
    'params' => $params,
];
