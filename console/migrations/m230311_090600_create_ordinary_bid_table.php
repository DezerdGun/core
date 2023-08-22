<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ordinary_bid}}`.
 */
class m230311_090600_create_ordinary_bid_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ordinary_bid}}', [
            'id' => $this->primaryKey(),
            'is_favorite' => $this->boolean()->notNull(),
            'listing_ordinary_id' => $this->integer()->notNull(),
            'note' => $this->string(),
            'edit_counting' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey(
            'fk-ordinary_bid_listing_ordinary_id',
            'ordinary_bid',
            'listing_ordinary_id',
            'listing_ordinary',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-ordinary_bid_user_id',
            'ordinary_bid',
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
            'fk-ordinary_bid_listing_ordinary_id',
            'ordinary_bid'
        );

        $this->dropForeignKey(
            'fk-ordinary_bid_user_id',
            'ordinary_bid'
        );
        $this->dropTable('{{%ordinary_bid}}');
    }
}
