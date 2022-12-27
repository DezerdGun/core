<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%location}}`.
 */
class m221219_064913_add_contact_info_id_column_to_location_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('location', 'contact_info_id', $this->integer());
        $this->addForeignKey(
            'fk-location-contact_info_id',
            'location',
            'contact_info_id',
            'contact_info',
            'id',
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
            'fk-location-contact_info_id',
            'location'
        );
        $this->dropColumn('location', 'contact_info_id');
    }
}
