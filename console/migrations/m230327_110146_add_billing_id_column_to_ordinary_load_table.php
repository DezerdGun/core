<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%ordinary_load}}`.
 */
class m230327_110146_add_billing_id_column_to_ordinary_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ordinary_load', 'billing_id', $this->integer()->unique());
        $this->addForeignKey(
            'fk-ordinary_load-billing_id',
            'ordinary_load',
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
            'fk-ordinary_load-billing_id',
            'ordinary_load'
        );
        $this->dropColumn(
            'ordinary_load',
            'billing_id'
        );
    }
}
