<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%load}}`.
 */
class m230323_115501_add_billing_id_column_to_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('load', 'billing_id', $this->integer()->unique());
        $this->addForeignKey(
            'fk-load-billing_id',
            'load',
            'billing_id',
            'billing',
            'id',
            'SET NULL',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-load-billing_id',
            'load'
        );
        $this->dropColumn(
            'load',
            'billing_id'
        );
    }
}
