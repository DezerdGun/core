<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%holds}}`.
 */
class m230220_111420_create_holds_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%holds}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer(),
            'freight_hold' => $this->string(),
            'customer_hold' => $this->string(),
            'carrier_hold' => $this->string(),
            'broker_hold' => $this->string()
        ]);
        $this->addForeignKey(
            '{{%holds_load_id_fk_load}}',
            '{{%holds}}',
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
        $this->dropTable('{{%holds}}');
        $this->dropForeignKey(
            '{{%holds_load_id_fk_load}}',
            '{{%holds}}'
        );
    }
}
