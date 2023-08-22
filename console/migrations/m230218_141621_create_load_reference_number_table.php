<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%load_reference_number}}`.
 */
class m230218_141621_create_load_reference_number_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%load_reference_number}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer(),
            'master_bill_of_loading' => $this->string(32),
            'house_bill_of_loading' => $this->string(32),
            'seal' => $this->string(32),
            'vessel_name' => $this->string(32),
            'voyage' => $this->string(32),
            'purchase_order' => $this->string(32),
            'shipment' => $this->string(32),
            'pick_up' => $this->string(32),
            'appointment' => $this->string(32),
            'return' => $this->string(32),
            'reservation' => $this->string(32),
        ]);
        $this->addForeignKey(
            '{{%load_reference_number_load_id_fk_load}}',
            '{{%load_reference_number}}',
            'load_id',
            '{{%load}}',
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
        $this->dropTable('{{%load_reference_number}}');
        $this->dropForeignKey(
            '{{%load_reference_number_load_id_fk_load}}',
            '{{%load_reference_number}}'
        );
    }
}
