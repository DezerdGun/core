<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ordinary_bid_detail}}`.
 */
class m230311_091508_create_ordinary_bid_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ordinary_bid_detail}}', [
            'id' => $this->primaryKey(),
            'ordinary_bid_id' => $this->integer(),
            'charge_id' => $this->integer(),
            'measure_id' => $this->integer(),
            'price' => $this->decimal(8, 2),
            'free_unit' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-ordinary_bid_detail-ordinary_bid_id',
            'ordinary_bid_detail',
            'ordinary_bid_id',
            'ordinary_bid',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-ordinary_bid_detail-charge_id',
            'ordinary_bid_detail',
            'charge_id',
            'charge',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-ordinary_bid_detail-measure_id',
            'ordinary_bid_detail',
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
            'fk-ordinary_bid_detail-ordinary_bid_id',
            'ordinary_bid_detail'
        );

        $this->dropForeignKey(
            'fk-ordinary_bid_detail-charge_id',
            'ordinary_bid_detail'
        );

        $this->dropForeignKey(
            'fk-ordinary_bid_detail-measure_id',
            'ordinary_bid_detail'
        );
        $this->dropTable('{{%ordinary_bid_detail}}');
    }
}
