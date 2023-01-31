<?php

use yii\db\Migration;

/**
 * Class m230128_173039_edit_load_column_table
 */
class m230128_173039_edit_load_column_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%load}}','vessel_eta');
        $this->addColumn('{{load}}','vessel_eta',$this->integer(32));
        $this->addColumn('{{load}}','pick_up_from',$this->date());
        $this->addColumn('{{load}}','pick_up_to',$this->date());
        $this->addColumn('{{load}}','delivery_from',$this->date());
        $this->addColumn('{{load}}','delivery_to',$this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230128_173039_edit_load_column_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230128_173039_edit_load_column_table cannot be reverted.\n";

        return false;
    }
    */
}
