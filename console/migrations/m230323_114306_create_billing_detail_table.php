<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%billing_detail}}`.
 */
class m230323_114306_create_billing_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%billing_detail}}', [
            'id' => $this->primaryKey(),
            'billing_id' => $this->integer(),
            'charge_id' => $this->integer(),
            'description' => $this->string(250),
            'price' => $this->decimal(8, 2),
            'unit_count' => $this->integer(),
            'measure_id' => $this->integer(),
            'free_unit' => $this->integer(),
            'per_unit' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-billing_detail-billing_id',
            'billing_detail',
            'billing_id',
            'billing',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-billing_detail-charge_id',
            'billing_detail',
            'charge_id',
            'charge',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-billing_detail-measure_id',
            'billing_detail',
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
            'fk-billing_detail-billing_id',
            'billing_detail'
        );

        $this->dropForeignKey(
            'fk-billing_detail-charge_id',
            'billing_detail'
        );

        $this->dropForeignKey(
            'fk-billing_detail-measure_id',
            'billing_detail'
        );
        $this->dropTable('{{%billing_detail}}');
    }
}
