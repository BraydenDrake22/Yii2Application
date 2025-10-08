<?php
namespace frontend\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class BugReportModel extends ActiveRecord
{

    public const STATUSES   = ['Open' => 'Open', 'In Progress' => 'In Progress', 'Resolved' => 'Resolved', 'Closed' => 'Closed'];
    public const SEVERITIES = ['Low' => 'Low', 'Medium' => 'Medium', 'High' => 'High', 'Critical' => 'Critical'];

    public static function tableName()
    {
        return '{{%bug_report}}';
    }

    public function behaviors()
    {
        return [TimestampBehavior::class];
    }


    public function rules()
    {
        return [
            [['title', 'description', 'reporter_name', 'reporter_email'], 'required'],
            [['description', 'steps_to_reproduce'], 'string'],
            [['title'], 'string', 'max' => 200],
            [['reporter_name', 'assignee'], 'string', 'max' => 100],
            [['reporter_email'], 'string', 'max' => 150],
            [['category'], 'string', 'max' => 100],
            [['environment'], 'string', 'max' => 200],
            [['severity'], 'in', 'range' => array_values(self::SEVERITIES)],
            [['status'], 'in', 'range' => array_values(self::STATUSES)],
            [['reporter_email'], 'email'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'severity' => 'Severity',
            'status' => 'Status',
            'category' => 'Category',
            'environment' => 'Environment',
            'steps_to_reproduce' => 'Steps to Reproduce',
            'reporter_name' => 'Reporter Name',
            'reporter_email' => 'Reporter Email',
            'assignee' => 'Assignee',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}