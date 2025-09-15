<?php
use yii\helpers\Url;

$isBackend = Yii::$app->id === 'app-backend';

$frontendItems = [
  ['label' => 'Dashboard', 'url' => ['/site/index'], 'icon' => 'cil-speedometer'],
  ['label' => 'UI Test',   'url' => ['/site/ui-test'], 'icon' => 'cil-layers'],
];

$backendItems = [
  ['label' => 'Admin Home', 'url' => ['/site/index'], 'icon' => 'cil-home'],
  ['label' => 'Users',      'url' => ['/user/index'], 'icon' => 'cil-user'],
  ['label' => 'Reports',    'url' => ['/report/index'], 'icon' => 'cil-chart-line'],
  ['label' => 'UI Test',    'url' => ['/site/ui-test'], 'icon' => 'cil-layers'],
];

$items = $isBackend ? $backendItems : $frontendItems;

foreach ($items as $it) {
  $icon = $it['icon'] ?? 'cil-circle';
  echo '<li class="nav-item"><a class="nav-link" href="'.Url::to($it['url']).'"><i class="nav-icon '.$icon.'"></i> '.htmlspecialchars($it['label']).'</a></li>';
}
