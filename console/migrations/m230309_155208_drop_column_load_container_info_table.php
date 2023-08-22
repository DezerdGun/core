<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%column_load_container_info}}`.
 */
class m230309_155208_drop_column_load_container_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%load_container_info}}','mbl');
        $this->dropColumn('{{%load_container_info}}','hbl');
        $this->dropColumn('{{%load_container_info}}','vessel_name');
        $this->renameColumn('load_reference_number','master_bill_of_loading', 'mbl');
        $this->renameColumn('load_reference_number', 'house_bill_of_loading','hbl');
        $this->dropForeignKey(
            '{{%load_reference_number_load_id_fk_load}}',
            '{{%load_reference_number}}'
        );
        $this->addForeignKey(
            '{{%load_reference_number_load_id_fk_load}}',
            '{{%load_reference_number}}',
            'load_id',
            '{{%load_container_info}}',
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
        $this->addColumn('{{%load_container_info}}','mbl',$this->string(32));
        $this->addColumn('{{%load_container_info}}','hbl',$this->string(32));
        $this->renameColumn('load_reference_number', 'mbl','master_bill_of_loading');
        $this->renameColumn('load_reference_number', 'hbl','house_bill_of_loading');
        $this->dropColumn('{{%load_container_info}}','vessel_name');
        $this->dropForeignKey(
            '{{%load_reference_number_load_id_fk_load}}',
            '{{%load_reference_number}}'
        );
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
}
