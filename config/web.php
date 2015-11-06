<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'MobiDev Surveys',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gon'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ioaOg5HW-J_COTFeD93N3xZ060zZQVyK',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:[\w\-]+>/<id:\d+>' => '<controller>/view',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'nickcv\mandrill\Mailer',
            'apikey' => 'pI63i_rfxEoqj_DDhgShwA',
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
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/modules/admin/views/users'
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'gon' => [
            'class' => 'app\components\GonComponent',
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Admin',
            'layoutPath' => '@app/modules/admin/views/layouts',
            'layout' => 'main',
            'defaultRoute' => 'dashboard',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'controllerMap' => [
                'admin' => [
                    'class' => 'app\modules\admin\controllers\UsersController',
                    'layout' => '@app/modules/admin/views/layouts/main',
                ],
            ],
        ],
        'rbac' => [
            'class' => 'app\modules\admin\overrides\Module',
            'basePath' => '@app/vendor/dektrium/yii2-rbac',
            'controllerMap' => [
                'role' => [
                    'class' => 'app\modules\admin\controllers\RoleController',
                    'layout' => '@app/modules/admin/views/layouts/main',
                ],
                'permission' => [
                    'class' => 'app\modules\admin\controllers\PermissionController',
                    'layout' => '@app/modules/admin/views/layouts/main',
                ],
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
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*']
    ];
}

return $config;
