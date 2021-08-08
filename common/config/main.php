<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'timeZone' => 'Asia/Tashkent',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'main*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'main' => 'main.php',
                        'main/error' => 'error.php'
                    ]
                ],
                'yii' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'yii' => 'yii.php',
                    ]
                ]
            ]
        ]
    ],
    'modules' => [
        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module',
            'displaySettings' => [
                'date' => 'dd.MM.yyyy',
                'time' => 'HH:mm:ss',
                'datetime' => 'dd.MM.yyyy HH:mm:ss',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                'date' => 'php:Y-m-d', // saves as unix timestamp
                'time' => 'php:H:i:s',
                'datetime' => 'php:Y-m-d H:i:s',
            ],

            // set your display timezone
//            'displayTimezone' => 'Asia/Tashkent',

            // set your timezone for date saved to db
//            'saveTimezone' => 'UTC',

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

        ],
        'i18n_interface' => [
            'class' => 'common\modules\i18n_interface\Module',
        ],
    ]
];
