<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ordinary_bid_log}}`.
 */
class m230317_060910_create_ordinary_bid_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ordinary_bid_log}}', [
            'id' => $this->primaryKey(),
            'ordinary_bid_id' => $this->integer(),
            'log_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-ordinary_bid_log_ordinary_bid_id',
            'ordinary_bid_log',
            'ordinary_bid_id',
            'ordinary_bid',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-ordinary_bid_log_log_id',
            'ordinary_bid_log',
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
            'fk-ordinary_bid_log_ordinary_bid_id',
            'ordinary_bid_log'
        );
        $this->dropForeignKey(
            'fk-ordinary_bid_log_log_id',
            'ordinary_bid_log'
        );

        $this->dropTable('{{%ordinary_bid_log}}');
    }
}
