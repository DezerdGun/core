<?php

use yii\db\Migration;

/**
 * Class m230314_172728_alter_fk_container_bid_log_table
 */
class m230314_172728_alter_fk_container_bid_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey(
            'fk-container_bid_log_container_bid_id',
            'container_bid_log'
        );
        $this->dropForeignKey(
            'fk-container_bid_log_log_id',
            'container_bid_log'
        );
        $this->addForeignKey(
            'fk-container_bid_log_container_bid_id',
            'container_bid_log',
            'container_bid_id',
            'container_bid',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-container_bid_log_log_id',
            'container_bid_log',
            'log_id',
            'log',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-container_bid_log_container_bid_id',
            'container_bid_log'
        );

        $this->dropForeignKey(
            'fk-container_bid_log_log_id',
            'container_bid_log'
        );

        $this->addForeignKey(
            'fk-container_bid_log_container_bid_id',
            'container_bid_log',
            'container_bid_id',
            'container_bid',
            'id'
        );

        $this->addForeignKey(
            'fk-container_bid_log_log_id',
            'container_bid_log',
            'log_id',
            'log',
            'id'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230314_172728_alter_fk_container_bid_log_table cannot be reverted.\n";

        return false;
    }
    */
}
