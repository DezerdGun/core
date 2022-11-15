<?php

use yii\db\Migration;

/**
 * Class m221029_131058_edit_load_bid_details_table
 */
class m221029_131058_edit_load_bid_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%load_bid_details}}','unit_count');
        $this->dropColumn('{{%load_bid_details}}','notes');

        $this->addColumn('{{load_bid_details}}','note_from_carrier',$this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221029_131058_edit_load_bid_details_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221029_131058_edit_load_bid_details_table cannot be reverted.\n";

        return false;
    }
    */
}
