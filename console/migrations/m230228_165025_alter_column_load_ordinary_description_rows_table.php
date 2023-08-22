<?php

use yii\db\Migration;

/**
 * Class m230228_165025_alter_column_load_ordinary_description_rows_table
 */
class m230228_165025_alter_column_load_ordinary_description_rows_table extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('load_ordinary_description', 'weight_LBs', $this->decimal(5,3));
        $this->alterColumn('load_ordinary_description_rows', 'weight_KGs', $this->decimal(6,2));
        $this->alterColumn('load_ordinary_description_rows', 'weight_LBs', $this->decimal(4,3));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('load_ordinary_description', 'weight_LBs',$this->decimal(3,0));
        $this->alterColumn('load_ordinary_description_rows', 'weight_KGs',$this->decimal(3,2));
        $this->alterColumn('load_ordinary_description_rows', 'weight_LBs',$this->decimal(3,2));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230228_165025_alter_column_load_ordinary_description_rows_table cannot be reverted.\n";

        return false;
    }
    */
}
