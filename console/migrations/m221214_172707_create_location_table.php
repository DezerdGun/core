<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%location}}`.
 */
class m221214_172707_create_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%location}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->unique(),
            'address_id' => $this->integer()->notNull(),
            'location_type' => $this->string(32),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        $this->addForeignKey(
            'fk-location-address_id',
            'location',
            'address_id',
            'address',
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
        // drops foreign key for table `location`
        $this->dropForeignKey(
            'fk-location-address_id',
            'location'
        );

        $this->dropTable('{{%location}}');
    }
}
