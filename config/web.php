<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'library',
    'name' => 'Public Library System',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'PEi6ICsok3vWiJSJJtQV2JZ6D-jk5gkh',
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
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
        // 'i18n' => []
        ],
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',
            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                kartik\datecontrol\Module::FORMAT_DATE => 'dd-MM-yyyy',
                kartik\datecontrol\Module::FORMAT_TIME => 'hh:mm:ss a',
                kartik\datecontrol\Module::FORMAT_DATETIME => 'dd-MM-yyyy hh:mm:ss a',
            ],
            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                kartik\datecontrol\Module::FORMAT_DATE => 'php:U', // saves as unix timestamp
                kartik\datecontrol\Module::FORMAT_TIME => 'php:H:i:s',
                kartik\datecontrol\Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
            // set your display timezone
            'displayTimezone' => 'Asia/Kuala_Lumpur',
            // set your timezone for date saved to db
            'saveTimezone' => 'UTC',
            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,
            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                kartik\datecontrol\Module::FORMAT_DATE => ['type' => 2, 'pluginOptions' => ['autoclose' => true]], // example
                kartik\datecontrol\Module::FORMAT_DATETIME => [], // setup if needed
                kartik\datecontrol\Module::FORMAT_TIME => [], // setup if needed
            ],
//            // custom widget settings that will be used to render the date input instead of kartik\widgets,
//            // this will be used when autoWidget is set to false at module or widget level.
//            'widgetSettings' => [
//            ]
        // other settings
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['192.168.1.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['192.168.1.*'],
    ];
}

return $config;
