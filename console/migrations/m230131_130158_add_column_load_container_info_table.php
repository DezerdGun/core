<?php

use yii\db\Migration;

/**
 * Class m230131_130158_add_column_load_container_info_table
 */
class m230131_130158_add_column_load_container_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{load_container_info}}','number');
        $this->addColumn('{{load_container_info}}','container_number',$this->integer(32));
        $this->addColumn('{{load_container_info}}','load_reference_number',$this->integer(32));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230131_130158_add_column_load_container_info_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230131_130158_add_column_load_container_info_table cannot be reverted.\n";

        return false;
    }
    */
}
