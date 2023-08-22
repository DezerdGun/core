<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['oauth2'],
    'defaultRoute' => 'swagger/index',
    'modules' => [
        'oauth2' => [
            'class' => \filsh\yii2\oauth2server\Module::class,
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600 * 24,
            'useJwtToken' => true,
            'storageMap' => [
                'user_credentials' => api\components\oauth2\UserCredentials::class,
                'public_key' => api\components\oauth2\PublicKeyStorage::class,
                'access_token' => \OAuth2\Storage\JwtAccessToken::class
            ],
            'grantTypes' => [
                'user_credentials' => [
                    'class' => \OAuth2\GrantType\UserCredentials::class
                ],
                'client_credentials' => [
                    'class' => \OAuth2\GrantType\ClientCredentials::class,
                    'allow_public_clients' => false,
                    'allow_credentials_in_request_body' => false
                ],
                'refresh_token' => [
                    'class' => \OAuth2\GrantType\RefreshToken::class,
                    'always_issue_new_refresh_token' => false,
                    'unset_refresh_token_after_use' => false
                ]
            ]
        ]
    ],
    'components' => [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' =>false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mailgun.org',
                'port' => 587,
                'encryption' => 'tls',
                'username' => 'info@mail.therealstart.com',
                'password' => 'e05d4d85813416b457e5ff0c1526b5ea-8845d1b1-c2fc6dc1',
            ],
            'messageConfig' => ['from' => 'info@mail.therealstart.com']
        ],
        'request' => [
            'parsers' => [
                'baseURL' => '/api',
                'application/json' => 'yii\web\JsonParser',
                'application/x-www-form-urlencoded' => 'yii\web\JsonParser',
                'multipart/form-data' => 'yii\web\MultipartFormDataParser'
            ]
        ],
        'user' => [
            'class' => api\components\oauth2\User::class,
            'identityClass' => api\components\oauth2\AppIdentity::class,
        ],
        'errorHandler' => [
            'class' => api\components\ErrorHandler::class,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/routes.php'),
        ],
        'formatter' => [
            'timeZone' => 'UTC',
            'datetimeFormat' => $params['formats']['ISO8601'],
        ],
    ],
    'params' => $params
];
