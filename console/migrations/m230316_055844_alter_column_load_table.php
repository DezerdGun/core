<?php

use yii\db\Migration;

/**
 * Class m230316_055844_alter_column_load_table
 */
class m230316_055844_alter_column_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%load}}','vessel_eta'); /* <- fk drop */
        $this->dropColumn('{{%date}}','vessel_eta');
        $this->addColumn('{{%load}}','vessel_eta',$this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%load}}','vessel_eta');
        $this->addColumn('{{%load}}','vessel_eta',$this->integer());
        $this->addColumn('{{%date}}','vessel_eta',$this->date());

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230316_055844_alter_column_load_table cannot be reverted.\n";

        return false;
    }
    */
}
