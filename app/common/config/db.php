<?php
$host = getenv('DB_HOST') ?: 'db';
$port = getenv('DB_PORT') ?: '3306';
$db   = getenv('DB_NAME') ?: 'yii2';
$user = getenv('DB_USER') ?: 'yii2';
$pass = getenv('DB_PASSWORD') ?: 'yii2';

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$host};port={$port};dbname={$db}",
    'username' => $user,
    'password' => $pass,
    'charset' => 'utf8mb4',
    'attributes' => [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_TIMEOUT => 5,
    ],
];
