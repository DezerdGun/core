<?php

use yii\db\Migration;

/**
 * Class m230123_172246_add_load_column_table
 */
class m230123_172246_add_load_column_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('load','status',$this->string(32));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230123_172246_add_load_column_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230123_172246_add_load_column_table cannot be reverted.\n";

        return false;
    }
    */
}
