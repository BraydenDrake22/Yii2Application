<?php

use yii\db\Migration;

class m250829_150010_add_rbac_basics extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250829_150010_add_rbac_basics cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250829_150010_add_rbac_basics cannot be reverted.\n";

        return false;
    }
    */
}
