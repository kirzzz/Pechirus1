<?php

use himiklab\sitemap\behaviors\SitemapBehavior;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'container' => [
        'definitions' => [
            'yii\widgets\LinkPager' => [
                'firstPageLabel' => 'Первая',
                'lastPageLabel'  => 'Последняя',
                'prevPageLabel' => '<',
                'nextPageLabel' => '>'
            ]
        ]
    ],
    'language' => 'ru',
    'timeZone' => 'Europe/Moscow',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            'cookieValidationKey' => 'rD3IyHUU71lAK6Bddkt2JZyQMGfD1bJY',
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
            'useFileTransport' => false,
            'viewPath' => '@app/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.timeweb.ru',
                'username' => 'info@pechirus.ru',
                'password' => 'aZJ3zTTL',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'maxLogFiles' => 10
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
                ['pattern' => 'b6d67ad0d1f949db', 'route' => 'YandexMarketYml/default/index', 'suffix' => '.yml'],
            ],
        ],

    ],
    'modules' => [
        'sitemap' => [
            'class' => 'himiklab\sitemap\Sitemap',
            'models' => [
                'app\models\Product',
                'app\models\Catalog',
            ],
            'urls'=> [
                [
                    'loc' => '/site/index',
                    'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                    'priority' => 0.7,
                ],
                [
                    'loc' => '/site/about-us',
                    'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                    'priority' => 0.5,
                ],
                [
                    'loc' => '/site/list',
                    'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                    'priority' => 0.8,
                ],
                [
                    'loc' => '/site/contact',
                    'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
                    'priority' => 0.5,
                ],
            ],
            'enableGzip' => false, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],
        'YandexMarketYml' => [
            'class' => 'corpsepk\yml\YandexMarketYml',
            'cacheExpire' => 1, // 1 second. Default is 24 hours
            'categoryModel' => 'app\models\YandexCategory',
            'shopOptions' => [
                'name' => 'ПечиРУС',
                'company' => 'pechirus.ru',
                'url' => 'http://pechirus.ru',
                'currencies' => [
                    [
                        'id' => 'RUB',
                        'rate' => 1
                    ]
                ],
            ],
            'offerModels' => [
                ['class' => 'app\models\Product'],
            ],
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
        'allowedIPs' => ['2.92.194.143'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1'],
    ];
}

return $config;
