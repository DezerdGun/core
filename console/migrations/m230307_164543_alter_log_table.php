<?php

use yii\db\Migration;

/**
 * Class m230307_164543_alter_log_table
 */
class m230307_164543_alter_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('log', 'detail', $this->string(2000));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('log', 'detail', $this->string(255));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230307_164543_alter_log_table cannot be reverted.\n";

        return false;
    }
    */
}
