<?php
return [
  'components' => [
    'db' => [
      'class' => 'yii\db\Connection',
      'dsn' => 'mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_NAME'),
      'username' => getenv('DB_USER'),
      'password' => getenv('DB_PASSWORD'),
      'charset' => 'utf8',
    ],
    'mailer' => [
      'class' => yii\swiftmailer\Mailer::class,
      // for development: writes emails to files under runtime/mail
      'useFileTransport' => true,
    ],
  ],
];
