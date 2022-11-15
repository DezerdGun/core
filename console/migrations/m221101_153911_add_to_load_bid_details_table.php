<?php

use yii\db\Migration;

/**
 * Class m221101_153911_add_to_load_bid_details_table
 */
class m221101_153911_add_to_load_bid_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{load_bid_details}}','edit_bid_details',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221101_153911_add_to_load_bid_details_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221101_153911_add_to_load_bid_details_table cannot be reverted.\n";

        return false;
    }
    */
}
