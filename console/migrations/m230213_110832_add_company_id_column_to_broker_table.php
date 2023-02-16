<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%broker}}`.
 */
class m230213_110832_add_company_id_column_to_broker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('broker', 'company_id', $this->integer());
        $this->addForeignKey(
            'fk-broker_company_id',
            'broker',
            'company_id',
            'company',
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
        $this->dropColumn('broker','company_id');
        $this->dropForeignKey('fk-broker_company_id');
    }
}
