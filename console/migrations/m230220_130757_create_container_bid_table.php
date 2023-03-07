<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%container_bid}}`.
 */
class m230220_130757_create_container_bid_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%container_bid}}', [
            'id' => $this->primaryKey(),
            'is_favorite' => $this->boolean()->notNull(),
            'listing_container_id' => $this->integer()->notNull(),
            'quantity' => $this->integer(),
            'note' => $this->string(),
            'edit_counting' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey(
            'fk-container_bid_listing_container_id',
            'container_bid',
            'listing_container_id',
            'listing_container',
            'id',
            'CASCADE',
            'CASCADE'
            );
        $this->addForeignKey(
            'fk-container_bid_user_id',
            'container_bid',
            'user_id',
            'user',
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
            'fk-container_bid_listing_container_id',
            'container_bid'
        );

        $this->dropForeignKey(
            'fk-container_bid_user_id',
            'container_bid'
        );
        $this->dropTable('{{%container_bid}}');
    }
}
