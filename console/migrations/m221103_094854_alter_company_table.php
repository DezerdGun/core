<?php

use yii\db\Migration;

/**
 * Class m221103_094854_alter_company_table
 */
class m221103_094854_alter_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('company', 'is_customer');
        $this->dropColumn('company', 'is_port');
        $this->dropColumn('company', 'is_consignee');
        $this->dropColumn('company', 'is_chassis');

        $this->addColumn('company', 'company_type', $this->string());
        $this->addColumn('company', 'dot', $this->string()->unique());
        $this->addColumn('company', 'created_at', $this->integer());
        $this->addColumn('company', 'updated_at', $this->integer());

        $this->alterColumn('company', 'company_name', $this->string()->unique());
        $this->alterColumn('company', 'address_id', $this->integer());
        $this->alterColumn('company', 'mc_number', $this->string(32)->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('company', 'is_customer', $this->boolean());
        $this->addColumn('company', 'is_port', $this->boolean());
        $this->addColumn('company', 'is_consignee', $this->boolean());
        $this->addColumn('company', 'is_chassis', $this->boolean());

        $this->dropColumn('company', 'company_type');
        $this->dropColumn('company', 'dot');
        $this->dropColumn('company', 'created_at');
        $this->dropColumn('company', 'updated_at');


        $this->alterColumn('company', 'company_name', $this->string(32));
        $this->alterColumn('company', 'address_id', $this->integer());
        $this->alterColumn('{{%company}}', 'mc_number', $this->string(32));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221103_094854_alter_company_table cannot be reverted.\n";

        return false;
    }
    */
}
