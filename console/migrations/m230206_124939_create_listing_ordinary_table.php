<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%listing_ordinary}}`.
 */
class m230206_124939_create_listing_ordinary_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%listing_ordinary}}', [
            'id' => $this->primaryKey(),
            'status' => $this->string(),
            'origin_id' => $this->integer(),
            'destination_id' => $this->integer(),
            'pick_up' => $this->date(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-listing_ordinary_origin_id',
            'listing_ordinary',
            'origin_id',
            'location',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-listing_ordinary_destination_id',
            'listing_ordinary',
            'destination_id',
            'location',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-listing_ordinary_user_id',
            'listing_ordinary',
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
            'fk-listing_ordinary_origin_id',
            'listing_ordinary'
        );

        $this->dropForeignKey(
            'fk-listing_ordinary_destination_id',
            'listing_ordinary'
        );

        $this->dropForeignKey(
            'fk-listing_ordinary_user_id',
            'listing_ordinary'
        );

        $this->dropTable('{{%listing_ordinary}}');
    }
}
