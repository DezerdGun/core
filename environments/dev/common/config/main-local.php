<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => sprintf(
                'pgsql:host=%s;port=%s;dbname=%s;user=%s;password=%s',
                getenv('DB_HOST'),
                getenv('DB_PORT'),
                getenv('DB_NAME'),
                getenv('DB_USER'),
                getenv('DB_PASSWORD')
            ),
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
