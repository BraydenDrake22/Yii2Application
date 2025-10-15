<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
?>
<div class="bug-report-view">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0"><?= Html::encode($this->title) ?></h1>
        <div class="btn-group">
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>

            <?php
            // No-JS delete: real POST form with CSRF, so VerbFilter allows it
            echo Html::beginForm(['delete', 'id' => $model->id], 'post', [
                'data-pjax' => '0',
                'class'     => 'd-inline-block', // keeps it inline with the Update button
            ]);
            echo Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken());
            echo Html::submitButton('Delete', [
                'class' => 'btn btn-danger',
                'data'  => ['confirm' => 'Are you sure you want to delete this item?'],
            ]);
            echo Html::endForm();
            ?>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'steps_to_reproduce:ntext',
            'severity',
            'status',
            'category',
            'environment',
            'reporter_name',
            'reporter_email:email',
            'assignee',
            ['attribute' => 'created_at', 'format' => ['datetime', 'php:Y-m-d H:i']],
            ['attribute' => 'updated_at', 'format' => ['datetime', 'php:Y-m-d H:i']],
        ],
    ]) ?>
</div>
