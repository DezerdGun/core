<?php

use yii\db\Migration;

/**
 * Class m230311_201455_alter_fk_ordinary_load_table
 */
class m230311_201455_alter_fk_ordinary_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ordinary_load','pick_up_from',$this->date());
        $this->addColumn('ordinary_load','pick_up_to',$this->date());
        $this->addColumn('ordinary_load','delivery_from',$this->date());
        $this->addColumn('ordinary_load','delivery_to',$this->date());
        $this->alterColumn('load_ordinary_description_rows', 'weight_KGs', $this->decimal(15,2));
        $this->alterColumn('load_ordinary_description_rows', 'weight_LBs', $this->decimal(15,2));
        $this->alterColumn('load_ordinary_description', 'weight_LBs', $this->decimal(15,3));
        $this->dropForeignKey(
            '{{%load_customer_id_fk}}',
            '{{%ordinary_load}}'
        );
        $this->dropForeignKey(
            '{{%load_ordinary_reference_number_load_id_fk_load}}',
            '{{%load_ordinary_reference_number}}'
        );
        $this->addForeignKey(
            '{{%load_ordinary_reference_number_load_id_fk_ordinary_load}}',
            '{{%load_ordinary_reference_number}}',
            'load_id',
            '{{%ordinary_load}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%load_customer_id_fk}}',
            '{{%ordinary_load}}',
            'customer_id',
            '{{%customer}}',
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
        $this->dropColumn('ordinary_load','pick_up_from');
        $this->dropColumn('ordinary_load','pick_up_to');
        $this->dropColumn('ordinary_load','delivery_from');
        $this->dropColumn('ordinary_load','delivery_to');
        $this->alterColumn('load_ordinary_description_rows', 'weight_KGs', $this->decimal(6,2));
        $this->alterColumn('load_ordinary_description_rows', 'weight_LBs', $this->decimal(5,2));
        $this->alterColumn('load_ordinary_description', 'weight_LBs', $this->decimal(9,3));
        $this->addForeignKey(
            '{{%load_customer_id_fk}}',
            '{{%ordinary_load}}',
            'customer_id',
            '{{%company}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%load_ordinary_reference_number_load_id_fk_load}}',
            '{{%load_ordinary_reference_number}}',
            'load_id',
            '{{%load}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->dropForeignKey(
            '{{%load_customer_id_fk}}',
            '{{%ordinary_load}}'
        );
        $this->dropForeignKey(
            '{{%load_ordinary_reference_number_load_id_fk_ordinary_load}}',
            '{{%load_ordinary_reference_number}}'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230311_201455_alter_fk_ordinary_load_table cannot be reverted.\n";

        return false;
    }
    */
}
