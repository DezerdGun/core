<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%listing_ordinary_info}}`.
 */
class m230206_142218_create_listing_ordinary_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%listing_ordinary_info}}', [
            'id' => $this->primaryKey(),
            'listing_ordinary_id' => $this->integer(),
            'quantity' => $this->integer(),
            'size' => $this->string(),
            'weight' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-listing_ordinary_info_listing_ordinary_id',
            'listing_ordinary_info',
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
            'fk-listing_ordinary_info_listing_ordinary_id',
            'listing_ordinary_info'
        );

        $this->dropTable('{{%listing_ordinary_info}}');
    }
}
