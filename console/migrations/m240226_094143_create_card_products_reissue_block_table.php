<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%card_products_reissue_block}}`.
 */
class m240226_094143_create_card_products_reissue_block_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%card_products_reissue_block}}', [
            'id' => $this->primaryKey(),
            'branch_id' => $this->string(255),
            'card_product_id' => $this->string(255),
            'blocked_from' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'blocked_to' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'branches_ec_id' => $this->string(10),
            'key' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%card_products_reissue_block}}');
    }
}
