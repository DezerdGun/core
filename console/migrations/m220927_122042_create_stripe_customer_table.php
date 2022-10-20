<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stripe_customer}}`.
 */
class m220927_122042_create_stripe_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stripe_customer}}', [
            'id' => $this->primaryKey(),
            'cus_id' => $this->string()->notNull()->unique(),
            'user_id' => $this->integer()->notNull()->unique(),
        ]);

        $this->addForeignKey(
            'fk-stripe_customer-user_id',
            'stripe_customer',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-stripe_customer-user_id',
            'stripe_customer'
        );
        $this->dropTable('{{%stripe_customer}}');
    }
}
