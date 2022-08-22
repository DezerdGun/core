<?php

use yii\db\Migration;

/**
 * Class m220807_155354_change_load_to_load_document_type
 */
class m220807_155354_change_load_to_load_document_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%load}}');
        $this->createTable("{{%load}}",[
            'id' => $this->primaryKey(),
            'load_type' => $this->string(32),
            'customer_id' => $this->integer()->notNull(),
            'port_id' => $this->integer()->notNull(),
            'consignee_id' => $this->integer()->notNull(),
            'route_type' => $this->string(32),
            'order' => $this->string(32),

        ]);

        $this->addForeignKey(
            '{{%load_id_fk}}',
            '{{%load}}',
            'customer_id',
            '{{%company}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%load_port_id_fk}}',
            '{{%load}}',
            'port_id',
            '{{%company}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%load_consignee_id_fk}}',
            '{{%load}}',
            'consignee_id',
            '{{%company}}',
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
        $this->dropForeignKey(
            '{{%load_id_fk}}',
            '{{%load}}'
        );
        $this->dropForeignKey(
            '{{%load_port_id_fk}}',
            '{{%load}}'
        );
        $this->dropForeignKey(
            '{{%load_consignee_id_fk}}',
            '{{%load}}'
        );
        $this->dropTable('{{%load}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220807_155354_change_load_to_load_document_type cannot be reverted.\n";

        return false;
    }
    */
}
