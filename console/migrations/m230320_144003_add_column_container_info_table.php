<?php

use yii\db\Migration;

/**
 * Class m230320_144003_add_column_container_info_table
 */
class m230320_144003_add_column_container_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%load_container_info}}', 'weight_in_LBs' , $this->decimal(15,3));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%load_container_info}}','weight_in_LBs');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230320_144003_add_column_container_info_table cannot be reverted.\n";

        return false;
    }
    */
}
