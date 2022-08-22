<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%load_stop}}`.
 */
class m220816_163816_create_load_stop_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%load_stop}}', [
            'id' => $this->primaryKey(),
            'port_id' => $this->integer()->notNull(),
            'stop_type' => $this->string(32),
            'company_id' => $this->integer()->notNull(),
            'from' => $this->dateTime(),
            'to' => $this->dateTime(),

        ]);

        $this->addForeignKey(
            '{{%load_stop_fk}}',
            '{{%load_stop}}',
            'port_id',
            '{{%load}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%load_stop_company_fk}}',
            '{{%load_stop}}',
            'company_id',
            '{{%load}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%load_stop}}');
    }
}
