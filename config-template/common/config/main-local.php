<?php
return [
    'components' => [
        'db' => require __DIR__ . '/db.php',
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => ['dsn' => 'smtp://mail:1025'],
        ],
    ],
];
