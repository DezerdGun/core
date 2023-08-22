<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%listing_ordinary_additional_info}}`.
 */
class m230206_142248_create_listing_ordinary_additional_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%listing_ordinary_additional_info}}', [
            'id' => $this->primaryKey(),
            'listing_ordinary_id' => $this->integer(),
            'hazmat_description' => $this->string(255),
            'overweight_description' => $this->string(255),
            'reefer_description' => $this->string(255),
            'alcohol_description' => $this->string(255),
            'urgent_description' => $this->string(255),
            'note' => $this->string(255),
        ]);
        $this->addForeignKey(
            'fk-listing_ordinary_additional_info_listing_ordinary_id',
            'listing_ordinary_additional_info',
            'listing_ordinary_id',
            'listing_ordinary',
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
            'fk-listing_ordinary_additional_info_listing_ordinary_id',
            'listing_ordinary_additional_info'
        );

        $this->dropTable('{{%listing_ordinary_additional_info}}');
    }
}
