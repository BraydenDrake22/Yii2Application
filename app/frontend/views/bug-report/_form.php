<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\BugReportModel;


/** @var $model BugReport */
?>
<div class="bug-report-form">
    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-md-8"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'category')->textInput() ?></div>
    </div>


    <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
    <?= $form->field($model, 'steps_to_reproduce')->textarea(['rows' => 5]) ?>


    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'severity')->dropDownList(BugReportModel::SEVERITIES) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'status')->dropDownList(BugReportModel::STATUSES) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'environment')->textInput() ?></div>
    </div>


    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'reporter_name')->textInput() ?></div>
        <div class="col-md-4"><?= $form->field($model, 'reporter_email')->input('email') ?></div>
        <div class="col-md-4"><?= $form->field($model, 'assignee')->textInput() ?></div>
    </div>


    <div class="form-group mt-3">
        <?= Html::submitButton($model->isNewRecord ? 'Submit Bug' : 'Save Changes', ['class' => 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>
</div>