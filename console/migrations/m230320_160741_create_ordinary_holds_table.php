<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ordinary_holds}}`.
 */
class m230320_160741_create_ordinary_holds_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ordinary_holds}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer(),
            'freight_hold' => $this->string(),
            'customer_hold' => $this->string(),
            'carrier_hold' => $this->string(),
            'broker_hold' => $this->string()
        ]);
        $this->addForeignKey(
            '{{%ordinary_holds_load_id_fk_ordinary_load}}',
            '{{%ordinary_holds}}',
            'load_id',
            '{{%ordinary_load}}',
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
            '{{%ordinary_holds_load_id_fk_ordinary_load}}',
            '{{%ordinary_holds}}'
        );
        $this->dropTable('{{%ordinary_holds}}');

    }
}
