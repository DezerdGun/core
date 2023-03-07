<?php

use yii\db\Migration;

/**
 * Class m230221_130227_rename_charge_code_table
 */
class m230221_130227_rename_charge_code_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('charge_code', 'charge');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable('charge', 'charge_code');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230221_130227_rename_charge_code_table cannot be reverted.\n";

        return false;
    }
    */
}
