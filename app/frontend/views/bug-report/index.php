<?php
use yii\grid\GridView;
use yii\helpers\Html;
use frontend\models\BugReportModel;


$this->title = 'Bug Reports';
?>
    <div class="bug-report-index">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0"><?= Html::encode($this->title) ?></h1>
            <?= Html::a('Submit Bug', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>


    <div class="card p-3 mb-3">
        <form class="row g-2">
            <div class="col-md-4">
                <input type="text" class="form-control" name="BugReportSearch[q]" value="<?= Html::encode($searchModel->q) ?>" placeholder="Search title or reporter name">
            </div>
            <div class="col-md-3">
                <select class="form-select" name="BugReportSearch[status]">
                    <option value="">All Statuses</option>
                    <?php foreach (BugReportModel::STATUSES as $k => $v): ?>
                        <option value="<?= $v ?>" <?= $searchModel->status === $v ? 'selected' : '' ?>><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="BugReportSearch[severity]">
                    <option value="">All Severities</option>
                    <?php foreach (BugReportModel::SEVERITIES as $k => $v): ?>
                        <option value="<?= $v ?>" <?= $searchModel->severity === $v ? 'selected' : '' ?>><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-secondary">Filter</button>
            </div>
        </form>
    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => fn($m) => Html::a(Html::encode($m->title), ['view', 'id' => $m->id]),
            ],
            'reporter_name',
            'reporter_email:email',
            'assignee',
            'category',
            'severity',
            'status',
            [
                'attribute' => 'created_at',
                'format' => ['datetime', 'php:Y-m-d H:i'],
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>
</div>