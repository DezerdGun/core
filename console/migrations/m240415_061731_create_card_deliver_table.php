<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%card_deliver}}`.
 */
class m240415_061731_create_card_deliver_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%card_delivery}}', [
            'id' => $this->primaryKey(),
            'branch' => $this->string(50),
            'product_id' => $this->string(50),
            'operation' => $this->string(50),
            'design' => $this->string(50),
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
            'updated_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
            'deleted_at' => $this->timestamp()->null(),
        ]);

        // Insert initial data
        $this->batchInsert('{{%card_delivery}}', ['branch', 'product_id', 'operation', 'design'], [
            ['00444', null, 'all', 'all'],
            ['01101', null, 'all', 'all'],
            ['00999', null, 'all', 'all'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%card_delivery}}');
    }
}
