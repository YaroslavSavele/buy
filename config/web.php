<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'sourceLanguage' => 'ru-RU',
    'timeZone' => 'Europe/Moscow',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'JDswihsLdKljfvS5i1vSrvtDYVqtUchG',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                  'class' => 'Swift_SmtpTransport',
                  'host' => 'smtp.mail.ru',
                  'username' => 'hero34@mail.ru',
                  'password' => 'etWJ1AbvZqhjdSh3qiMx',
                  'port' => 465,
                  'encryption' => 'ssl',
              ],
            'useFileTransport' => false,
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
        'db' => $db,
       
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'offers/edit/:<id:\d+>' => 'offers/edit',
                'offers/view/:<id:\d+>' => 'offers/view',
                //'offers/category/page/:\d+>' => 'offers/category',
                'offers/category/:<id:\d+>' => 'offers/category',
            ],
        ],
        'authClientCollection' => [
         'class' => 'yii\authclient\Collection',
         'clients' => [
            'vkontakte' => [
               'class' => 'yii\authclient\clients\VKontakte',
               'clientId' => '8119099',
               'clientSecret' => 'oWwX7WJVTaTiWderDjjN',
            ],
         ],
     ],
       'formatter' => [
            'defaultTimeZone' => 'Europe/Moscow', // задать часовой пояс
            'locale' => 'ru-RU'
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
