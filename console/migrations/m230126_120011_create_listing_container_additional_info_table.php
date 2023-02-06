<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%listing_additional_info}}`.
 */
class m230126_120011_create_listing_container_additional_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%listing_container_additional_info}}', [
            'id' => $this->primaryKey(),
            'listing_container_id' => $this->integer(),
            'hazmat_description' => $this->string(255),
            'overweight_description' => $this->string(255),
            'reefer_description' => $this->string(255),
            'alcohol_description' => $this->string(255),
            'urgent_description' => $this->string(255),
            'note' => $this->string(255),
        ]);
        $this->addForeignKey(
            'fk-listing_container_additional_info_listing_container_id',
            'listing_container_additional_info',
            'listing_container_id',
            'listing_container',
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
            'fk-listing_container_additional_info_listing_container_id',
            'listing_container_additional_info'
        );
        $this->dropTable('{{%listing_container_additional_info}}');
    }
}
