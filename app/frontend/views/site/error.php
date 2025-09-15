<?php
use yii\helpers\Html;
/* @var $name string */
/* @var $message string */
/* @var $exception \Throwable */
$this->title = $name;
?>
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card border-danger">
      <div class="card-header bg-danger text-white">
        <h5 class="m-0"><?= Html::encode($name) ?></h5>
      </div>
      <div class="card-body">
        <p class="lead mb-3"><?= nl2br(Html::encode($message)) ?></p>
        <a class="btn btn-primary" href="/">Go Home</a>
        <?php if (YII_ENV_DEV): ?>
          <hr><pre class="mb-0 small text-muted"><?= Html::encode($exception) ?></pre>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
