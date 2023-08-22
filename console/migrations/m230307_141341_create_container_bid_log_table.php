<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%container_bid_log}}`.
 */
class m230307_141341_create_container_bid_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%container_bid_log}}', [
            'id' => $this->primaryKey(),
            'container_bid_id' => $this->integer(),
            'log_id' => $this->integer()
        ]);
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

        $this->dropTable('{{%container_bid_log}}');
    }
}
