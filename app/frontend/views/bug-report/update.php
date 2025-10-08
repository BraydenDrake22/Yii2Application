<?php
use yii\helpers\Html;


$this->title = 'Update Bug: ' . $model->title;
?>
<div class="bug-report-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>