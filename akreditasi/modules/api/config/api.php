<?php

use common\models\Api;
use yii\web\User;

return [
    'urlManager' => [
        'class' => 'yii\web\UrlManager',
        // Disable index.php
        'showScriptName' => false,
        // Disable r= routes
        'enablePrettyUrl' => true,
        'enableStrictParsing' => false,
        'rules' => [
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'akreditasi-prodi',
                'except' => [
                    'create',
                    'delete',
                    'update'
                ],
                'ruleConfig' => [
                    'class' => 'yii\web\UrlRule',
                    'defaults' => [
                        'expand' => 'prodi'
                    ]
                ]
            ],
//                ['class' => 'yii\rest\UrlRule', 'controller' => 'auth'],
        ],
    ],
    'request' => [
        'class' => '\yii\web\Request',
        'enableCookieValidation' => false,
        'parsers' => [
            'application/json' => 'yii\web\JsonParser',
        ],
    ],

    'response' => [
        'class' => 'yii\web\Response',
        'on beforeSend' => function ($event) {
            $response = $event->sender;
            if ($response->data !== null && Yii::$app->request->get('suppress_response_code')) {
                $response->data = [
                    'success' => $response->isSuccessful,
                    'data' => $response->data,
                ];
                $response->statusCode = 200;
            }
        },
        'formatters' => [
            \yii\web\Response::FORMAT_JSON => [
                'class' => 'yii\web\JsonResponseFormatter',
                'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                // ...
            ],
        ],
        'format' => \yii\web\Response::FORMAT_JSON,


    ],
    'user' => [
        'class' => User::class,
        'identityClass' => Api::class,
        'enableSession' => false,
        'loginUrl' => null,
    ],
];
