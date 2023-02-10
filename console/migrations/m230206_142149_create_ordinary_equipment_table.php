<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ordinary_equipment}}`.
 */
class m230206_142149_create_ordinary_equipment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ordinary_equipment}}', [
            'id' => $this->primaryKey(),
            'listing_ordinary_id' => $this->integer(),
            'equipment_code' => $this->string()
        ]);
        $this->addForeignKey(
            'fk-ordinary_equipment_listing_ordinary_id',
            'ordinary_equipment',
            'listing_ordinary_id',
            'listing_ordinary',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-ordinary_equipment_equipment_id',
            'ordinary_equipment',
            'equipment_code',
            'equipment',
            'code',
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
            'fk-ordinary_equipment_listing_ordinary_id',
            'ordinary_equipment'
        );

        $this->dropForeignKey(
            'fk-ordinary_equipment_equipment_id',
            'ordinary_equipment'
        );

        $this->dropTable('{{%ordinary_equipment}}');
    }
}
