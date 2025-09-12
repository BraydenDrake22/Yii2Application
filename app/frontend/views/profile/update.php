<?php
/** @var \yii\web\View $this */
/** @var \frontend\models\ProfileForm $model */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Profile';
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="row">
  <div class="col-lg-6">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'placeholder'=>'+1 555 123 4567']) ?>

    <div class="form-group">
      <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
      <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>
