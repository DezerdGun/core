<?php

use yii\db\Migration;

/**
 * Class m230304_103102_alter_column_load_ordinary_description_rows_table
 */
class m230304_103102_alter_column_load_ordinary_description_rows_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%load_ordinary_description_rows}}', 'weight_LBs',$this->decimal(9,3));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%load_ordinary_description_rows}}', 'weight_LBs',$this->decimal(4,3));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230304_103102_alter_column_load_ordinary_description_rows_table cannot be reverted.\n";

        return false;
    }
    */
}
