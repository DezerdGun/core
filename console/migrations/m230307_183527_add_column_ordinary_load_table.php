<?php

use yii\db\Migration;

/**
 * Class m230307_183527_add_column_ordinary_load_table
 */
class m230307_183527_add_column_ordinary_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ordinary_load}}','load_reference_number',$this->integer(32));
        $this->dropColumn('{{%load_ordinary_additional_info}}','weight_in_LBs_description');
        $this->dropColumn('{{%load_ordinary_additional_info}}','weight_in_LBs');
        $this->addColumn('{{%load_ordinary_additional_info}}','weight_in_LBs',$this->integer(32));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ordinary_load}}','load_reference_number');
        $this->addColumn('{{%load_ordinary_additional_info}}','weight_in_LBs_description', $this->string(255));
        $this->addColumn('{{%load_ordinary_additional_info}}','weight_in_LBs',$this->string());
        $this->dropColumn('{{%load_ordinary_additional_info}}','weight_in_LBs');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230307_183527_add_column_ordinary_load_table cannot be reverted.\n";

        return false;
    }
    */
}
