<?php

use yii\db\Migration;

class m250829_145945_create_post_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id'         => $this->primaryKey(),
            'title'      => $this->string()->notNull(),
            'body'       => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $now = time();
        $this->batchInsert('{{%post}}', ['title', 'body', 'created_at', 'updated_at'], [
            ['Welcome to Yii2', 'This is the first sample post', $now, $now],
            ['Second Post',     'Another bit of content',       $now, $now],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
