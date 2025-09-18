<?php
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'UI Test';
?>

<div class="card mb-4">
  <div class="card-header"><strong>GridView</strong></div>
  <div class="card-body">
    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'tableOptions' => ['class' => 'table table-striped table-hover align-middle'],
      'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id','name','email',
        ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}'],
      ],
    ]) ?>
  </div>
</div>

<div class="card mb-4">
  <div class="card-header"><strong>DetailView</strong></div>
  <div class="card-body">
    <?= DetailView::widget([
      'model' => $detailModel,
      'options' => ['class' => 'table table-bordered'],
      'attributes' => ['id','title','status'],
    ]) ?>
  </div>
</div>

<div class="card mb-4">
  <div class="card-header"><strong>ActiveForm</strong></div>
  <div class="card-body">
    <?php $form = ActiveForm::begin(['fieldConfig' => [
      'options' => ['class' => 'mb-3'],
      'labelOptions' => ['class' => 'form-label'],
      'inputOptions' => ['class' => 'form-control'],
      'errorOptions' => ['class' => 'invalid-feedback d-block'],
    ]]); ?>
      <?= $form->field($model, 'name') ?>
      <?= $form->field($model, 'email') ?>
      <?= $form->field($model, 'subject') ?>
      <?= $form->field($model, 'body')->textarea(['rows' => 4]) ?>
      <div class="mt-3"><?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?></div>
    <?php ActiveForm::end(); ?>
  </div>
</div>
