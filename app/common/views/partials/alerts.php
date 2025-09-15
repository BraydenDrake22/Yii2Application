<?php
use yii\helpers\Html;

$map = [
  'success' => 'alert-success',
  'error'   => 'alert-danger',
  'warning' => 'alert-warning',
  'info'    => 'alert-info',
];

$session = Yii::$app->session;
foreach ($session->getAllFlashes(true) as $type => $messages) {
  $class = $map[$type] ?? 'alert-info';
  foreach ((array)$messages as $message) {
    echo Html::tag('div',
      Html::encode($message) .
      '<button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>',
      ['class' => "alert $class alert-dismissible fade show", 'role' => 'alert']
    );
  }
}
