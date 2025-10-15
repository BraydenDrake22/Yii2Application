<?php

use yii\db\Migration;

class m251008_124202_create_bug_report_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%bug_report}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200)->notNull(),
            'description' => $this->text()->notNull(),
            'severity' => $this->string(20)->notNull()->defaultValue('Medium'),
            'status' => $this->string(20)->notNull()->defaultValue('Open'),
            'category' => $this->string(100),
            'environment' => $this->string(200),
            'steps_to_reproduce' => $this->text(),
            'reporter_name' => $this->string(100)->notNull(),
            'reporter_email' => $this->string(150)->notNull(),
            'assignee' => $this->string(100),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx_bug_status', '{{%bug_report}}', 'status');
        $this->createIndex('idx_bug_severity', '{{%bug_report}}', 'severity');
        $this->createIndex('idx_bug_reporter', '{{%bug_report}}', 'reporter_name');
        $this->createIndex('idx_bug_created', '{{%bug_report}}', 'created_at');
    }

    public function safeDown()
    {
        $this->dropTable('{{%bug_report}}');
    }
}
