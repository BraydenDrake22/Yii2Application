<?php
namespace frontend\tests\_support\Fixtures;

use yii\test\ActiveFixture;

class BugReportFixture extends ActiveFixture
{
    public $tableName = 'bug_report';
    public $dataFile = '@frontend/tests/_data/bug_report.php';
}
