<?php
use yii\helpers\ArrayHelper;

$commonMain        = require __DIR__ . "/../../common/config/main.php";
$commonMainLocal   = is_file(__DIR__ . "/../../common/config/main-local.php") ? require __DIR__ . "/../../common/config/main-local.php" : [];
$frontendMain      = require __DIR__ . "/main.php";
$frontendMainLocal = is_file(__DIR__ . "/main-local.php") ? require __DIR__ . "/main-local.php" : [];
$commonTestLocal   = is_file(__DIR__ . "/../../common/config/test-local.php") ? require __DIR__ . "/../../common/config/test-local.php" : [];

$frontendTest = [
  "components" => [
    "assetManager" => ["basePath" => "@frontend/web/assets-test"],
    "request" => [
      "cookieValidationKey" => "test-key",
      "enableCsrfValidation" => false,
    ],
  ],
];

return ArrayHelper::merge(
  $commonMain,
  $commonMainLocal,
  $frontendMain,
  $frontendMainLocal,
  $commonTestLocal,
  $frontendTest
);
