<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%ordinary_load}}`.
 */
class m230324_062102_add_carrier_id_column_to_ordinary_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ordinary_load', 'carrier_id', $this->integer());

        $this->addForeignKey(
            'fk-ordinary_load_carrier_id',
            'ordinary_load',
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
        $this->dropForeignKey('fk-ordinary_load_carrier_id', 'ordinary_load');
        $this->dropColumn('ordinary_load', 'carrier_id');
    }
}
