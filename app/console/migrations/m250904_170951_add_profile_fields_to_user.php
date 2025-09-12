<?php

use yii\db\Migration;

class m250904_170951_add_profile_fields_to_user extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'first_name', $this->string(64)->null());
        $this->addColumn('{{%user}}', 'last_name',  $this->string(64)->null());
        $this->addColumn('{{%user}}', 'phone',      $this->string(32)->null());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'phone');
        $this->dropColumn('{{%user}}', 'last_name');
        $this->dropColumn('{{%user}}', 'first_name');
    }
}
