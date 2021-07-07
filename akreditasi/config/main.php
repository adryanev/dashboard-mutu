<?php

use kartik\datecontrol\Module;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'dashboard-akreditasi',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'akreditasi\controllers',
    'modules'=>[
        'profile' => [
            'class' => 'common\modules\profile\Profile'
        ],
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',
            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd MMMM yyyy',
                Module::FORMAT_TIME => 'HH:mm:ss',
                Module::FORMAT_DATETIME => 'dd MMMM yyyy HH:mm:ss',
            ],
            'saveTimezone' => 'Asia/Jakarta',
            'displayTimezone' => 'Asia/Jakarta',
            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:U', // saves as unix timestamp
                Module::FORMAT_TIME => 'php:U',
                Module::FORMAT_DATETIME => 'php:U',
            ],


            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-akreditasi',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-dashboard-akreditasi', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the akreditasi
            'name' => 'dashboard-akreditasi',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => '@common/assets/metronic/assets',

                    'css' => ['css/style.bundle.css']
                ]
            ]
        ],

    ],
    'params' => $params,
];
