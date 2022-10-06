<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%load_bid_details}}`.
 */
class m220930_190608_create_load_bid_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%load_bid_details}}', [
            'id' => $this->primaryKey(),
            'load_bid_id' => $this->integer()->notNull(),
            'charge_code' => $this->integer(),
            'price' => $this->decimal(10,2),
            'unit_count' => $this->integer(),
            'unit_measure' => $this->string(32)->notNull(),
            'free_units' => $this->decimal(10,4),
            'notes' => $this->text()
        ]);

        $this->createIndex('{{%load_bid_details_id_load_bid_id_unique}}', '{{%load_bid_details}}', ['id', 'load_bid_id'], true);

        $this->addForeignKey(
            'load_bid_details_type_fk',
            'load_bid_details',
            'load_bid_id',
            'load_bid',
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
        $this->dropTable('{{%load_bid_details}}');
    }
}
