<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%carrier}}`.
 */
class m220719_070729_add_company_id_column_to_carrier_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('carrier', 'company_id', $this->integer()->unique());
        $this->addForeignKey(
            'fk-carrier-company_id',
            'carrier',
            'company_id',
            'company',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-carrier-company_id',
            'carrier'
        );

        $this->dropColumn('carrier', 'company_id');
    }
}
