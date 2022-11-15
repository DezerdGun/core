<?php

use yii\db\Migration;

/**
 * Class m221101_190533_add_to_load_additional_info
 */
class m221101_190533_add_to_load_additional_info extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{load_additional_info}}','hazmat_description',$this->string(255));
        $this->addColumn('{{load_additional_info}}','weight_in_lbs',$this->string(255));
        $this->addColumn('{{load_additional_info}}','temp_in_f',$this->string(255));
        $this->addColumn('{{load_additional_info}}','alcohol_description',$this->string(255));
        $this->addColumn('{{load_additional_info}}','urgent_description',$this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221101_190533_add_to_load_additional_info cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221101_190533_add_to_load_additional_info cannot be reverted.\n";

        return false;
    }
    */
}
