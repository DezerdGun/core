<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%listing_container}}`.
 */
class m230125_123700_create_listing_container_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%listing_container}}', [
            'id' => $this->primaryKey(),
            'status' => $this->string(),
            'port_id' => $this->integer(),
            'destination_id' => $this->integer(),
            'vessel_eta' => $this->date(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-listing_container_port_id',
            'listing_container',
            'port_id',
            'location',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-listing_container_destination_id',
            'listing_container',
            'destination_id',
            'location',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-listing_container_user_id',
            'listing_container',
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
            'fk-listing_container_port_id',
            'listing_container'
        );
        $this->dropForeignKey(
            'fk-listing_container_destination_id',
            'listing_container'
        );
        $this->dropForeignKey(
            'fk-listing_container_user_id',
            'listing_container'
        );
        $this->dropTable('{{%listing_container}}');
    }
}
