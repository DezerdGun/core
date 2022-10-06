<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%load_bid}}`.
 */
class m220930_182639_create_load_bid_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%load_bid}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer(),
            'carrier_id' => $this->integer(),
            'date' => $this->timestamp(),
        ]);

        $this->addForeignKey(
            'load_bid_type_fk',
            'load_bid',
            'load_id',
            'load',
            'id',
            'RESTRICT',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%load_bid}}');
    }
}
