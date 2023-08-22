<?php

use yii\db\Migration;

/**
 * Class m221215_100000_alter_address_state_code
 */
class m221215_100000_alter_address_state_code extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-address-state_code',
            'address',
            'state_code',
            'state',
            'state_code',
            'NO ACTION',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `address`
        $this->dropForeignKey(
            'fk-address-state_code',
            'address'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221215_100000_alter_address_state_code cannot be reverted.\n";

        return false;
    }
    */
}
