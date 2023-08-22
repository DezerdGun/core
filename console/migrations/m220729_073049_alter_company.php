<?php

use yii\db\Migration;

/**
 * Class m220729_073049_alter_company
 */
class m220729_073049_alter_company extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->delete('{{%company}}');
        $this->addColumn('{{%company}}', 'address_id', $this->integer()->notNull());
        $this->addColumn('{{%company}}', 'mc_number', $this->string(32));
        $this->addColumn('{{%company}}', 'email', $this->string(32));
        $this->addColumn('{{%company}}', 'receiver_email', $this->string(32));
        $this->addColumn('{{%company}}', 'billing_email', $this->string(32));
        $this->addColumn('{{%company}}', 'quickbooks_email', $this->string(32));
        $this->addColumn('{{%company}}', 'credit_limit', $this->string(32));
        $this->addColumn('{{%company}}', 'payment_terms', $this->string(32));

        $this->addColumn('{{%company}}', 'is_customer', $this->boolean());
        $this->addColumn('{{%company}}', 'is_port', $this->boolean());
        $this->addColumn('{{%company}}', 'is_consignee', $this->boolean());
        $this->addColumn('{{%company}}', 'is_chassis', $this->boolean());

        $this->dropColumn('{{%company}}', 'street_address',$this->string(32));
        $this->dropColumn('{{%company}}', 'city',$this->string(32));
        $this->dropColumn('{{%company}}', 'state',$this->string(32));
        $this->dropColumn('{{%company}}', 'zip_code',$this->string(32));
        $this->dropColumn('{{%company}}', 'country',$this->string(32));

        $this->addForeignKey(
            '{{%company_address_id_fk}}',
            '{{%company}}',
            'address_id',
            '{{%address}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company}}', 'payment_terms');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220729_073049_alter_company cannot be reverted.\n";

        return false;
    }
    */
}
