<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%container_bid_detail}}`.
 */
class m230222_071442_create_container_bid_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%container_bid_detail}}', [
            'id' => $this->primaryKey(),
            'container_bid_id' => $this->integer(),
            'charge_id' => $this->integer(),
            'measure_id' => $this->integer(),
            'price' => $this->decimal(8, 2),
            'free_unit' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-container_bid_detail-container_bid_id',
            'container_bid_detail',
            'container_bid_id',
            'container_bid',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-container_bid_detail-charge_id',
            'container_bid_detail',
            'charge_id',
            'charge',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-container_bid_detail-measure_id',
            'container_bid_detail',
            'measure_id',
            'measure',
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
            'fk-container_bid_detail-container_bid_id',
            'container_bid_detail'
        );

        $this->dropForeignKey(
            'fk-container_bid_detail-charge_id',
            'container_bid_detail'
        );

        $this->dropForeignKey(
            'fk-container_bid_detail-measure_id',
            'container_bid_detail'
        );

        $this->dropTable('{{%container_bid_detail}}');
    }
}
