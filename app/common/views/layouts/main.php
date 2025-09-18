<?php
use common\assets\CoreUiAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

CoreUiAsset::register($this);
$this->registerCsrfMetaTags();
$this->registerCssFile('@web/css/site-coreui.css', ['depends' => [CoreUiAsset::class]]);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body class="c-app">
<?php $this->beginBody() ?>

<div class="sidebar sidebar-fixed" id="sidebar">
  <div class="sidebar-brand d-none d-md-flex">
    <span class="ms-2 fw-semibold"><?= Html::encode(Yii::$app->name ?: 'Yii2 App') ?></span>
  </div>
  <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
    <?= $this->render('@common/views/partials/sidebar'); ?>
  </ul>
  <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>

<div class="wrapper d-flex flex-column min-vh-100 bg-light">
  <header class="header header-sticky mb-4">
    <div class="container-fluid">
      <button class="header-toggler px-md-0 me-md-3" type="button"
        onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
        <i class="cil-menu"></i>
      </button>
      <a class="header-brand d-md-none" href="#"><?= Html::encode(Yii::$app->name ?: 'Yii2'); ?></a>
      <ul class="header-nav ms-3">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
      </ul>
    </div>
    <div class="header-divider"></div>
    <div class="container-fluid">
      <?= Breadcrumbs::widget([
        'homeLink' => ['label' => 'Home', 'url' => ['/site/index']],
        'options'  => ['class' => 'breadcrumb my-0'],
        'itemTemplate' => "<li class=\"breadcrumb-item\">{link}</li>\n",
        'activeItemTemplate' => "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>\n",
      ]) ?>
    </div>
  </header>

  <div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <?= $this->render('@common/views/partials/alerts'); ?>
      <?= $content ?>
    </div>
  </div>

  <footer class="footer">
    <div><span>&copy; <?= date('Y') ?> <?= Html::encode(Yii::$app->name ?: 'Yii2 App') ?></span></div>
    <div class="ms-auto">Powered by CoreUI</div>
  </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
