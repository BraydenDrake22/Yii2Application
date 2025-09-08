<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=yii2-db;port=3306;dbname=yii2advanced',
            'username' => 'yii2advanced',
            'password' => 'secret',
            'charset' => 'utf8mb4',
            'attributes' => [
                PDO::ATTR_TIMEOUT => 5,
            ],
        ],
        'mailer' => [
          'class' => \yii\symfonymailer\Mailer::class,
          'viewPath' => '@common/mail',
          'useFileTransport' => true,
      ],
    ],
];
