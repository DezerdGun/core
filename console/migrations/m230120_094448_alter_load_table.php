<?php

use yii\db\Migration;

/**
 * Class m230120_094448_alter_load_table
 */
class m230120_094448_alter_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey(
            'load_id_fk',
            'load'
        );
        $this->dropForeignKey(
            'load_port_id_fk',
            'load'
        );
        $this->dropForeignKey(
            'load_consignee_id_fk',
            'load'
        );
        $this->dropColumn('load', 'customer_id');
        $this->dropColumn('load', 'port_id');
        $this->dropColumn('load', 'consignee_id');


        $this->addColumn('load', 'customer_id', $this->integer());
        $this->addColumn('load', 'port_id', $this->integer());
        $this->addColumn('load', 'consignee_id', $this->integer());
        $this->addColumn('load', 'user_id', $this->integer());

        $this->addForeignKey(
            '{{%load_customer_id_fk}}',
            '{{%load}}',
            'customer_id',
            '{{%customer}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%load_port_id_fk}}',
            '{{%load}}',
            'port_id',
            '{{%location}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%load_consignee_id_fk}}',
            '{{%load}}',
            'consignee_id',
            '{{%location}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%load_user_id_fk}}',
            '{{%load}}',
            'user_id',
            '{{%user}}',
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
            'fk-customer-company_id',
            'customer'
        );
        $this->dropForeignKey(
            'fk-customer-contact_info_id',
            'customer'
        );

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230120_094448_alter_load_table cannot be reverted.\n";

        return false;
    }
    */
}
