<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%load}}`.
 */
class m230324_062258_add_carrier_id_column_to_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('load', 'carrier_id', $this->integer());

        $this->addForeignKey(
            'fk-load_carrier_id',
            'load',
            'carrier_id',
            'carrier',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-load_carrier_id', 'load');
        $this->dropColumn('load', 'carrier_id');
    }
}
