<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%listing_container_info}}`.
 */
class m230127_165039_create_listing_container_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%listing_container_info}}', [
            'id' => $this->primaryKey(),
            'listing_container_id' => $this->integer()->unique()->notNull(),
            'weight' => $this->integer(),
            'quantity' => $this->integer(),
            'size' => $this->string(),
            'container_code' => $this->string(),
            'owner_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-listing_container_info_listing_container_id',
            'listing_container_info',
            'listing_container_id',
            'listing_container',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-listing_container_info_container_code',
            'listing_container_info',
            'container_code',
            'container',
            'code',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-listing_container_info_owner_id',
            'listing_container_info',
            'owner_id',
            'owner',
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
        $this->dropForeignKey
        (
            'fk-listing_container_info_listing_container_id',
            'listing_container_info'
        );
        $this->dropForeignKey
        (
            'fk-listing_container_info_container_code',
            'listing_container_info'
        );
        $this->dropForeignKey(
            'fk-listing_container_info_owner_id',
            'listing_container_info'
        );
        $this->dropTable('{{%listing_container_info}}');
    }
}
