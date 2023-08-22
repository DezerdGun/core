<?php

use yii\db\Migration;

/**
 * Class m230106_180245_alter_customer_table
 */
class m230106_180245_alter_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-customer-user_id',
            'customer'
        );
        $this->dropColumn('customer', 'user_id');
        $this->addColumn('customer', 'type', $this->string());
        $this->addColumn('customer', 'contact_name', $this->string());
        $this->addColumn('customer', 'job_title', $this->string());
        $this->addColumn('customer', 'company_id', $this->integer());
        $this->addColumn('customer', 'created_at', $this->integer());
        $this->addColumn('customer', 'updated_at', $this->integer());
        $this->addColumn('customer', 'contact_info_id', $this->integer());

        // add foreign key for table 'customer'
        $this->addForeignKey(
            'fk-customer-company_id',
            'customer',
            'company_id',
            'company',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table 'customer'
        $this->addForeignKey(
            'fk-customer-contact_info_id',
            'customer',
            'contact_info_id',
            'contact_info',
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
        $this->addColumn('customer', 'user_id', $this->integer());
        $this->dropColumn('customer', 'customer_type');
        $this->dropColumn('customer', 'contact_name');
        $this->dropColumn('customer', 'job_title');
        $this->dropColumn('customer', 'company_id');
        $this->dropColumn('customer', 'created_at');
        $this->dropColumn('customer', 'updated_at');
        $this->dropColumn('customer', 'contact_info_id');

        // add foreign key for table 'user'
        $this->addForeignKey(
            'fk-customer-user_id',
            'customer',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230106_180245_alter_customer_table cannot be reverted.\n";

        return false;
    }
    */
}
