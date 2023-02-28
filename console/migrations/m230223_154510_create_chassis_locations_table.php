<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chassis_locations}}`.
 */
class m230223_154510_create_chassis_locations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chassis_locations}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer(),
            'chassis_pickup' => $this->integer(),
            'chassis_termination' => $this->integer(),
        ]);
        $this->addForeignKey(
            '{{%chassis_locations_load_id_fk_load}}',
            '{{%chassis_locations}}',
            'load_id',
            '{{%load}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%chassis_locations_chassis_pickup_fk_location}}',
            '{{%chassis_locations}}',
            'chassis_pickup',
            '{{%location}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%chassis_locations_chassis_termination_fk_location}}',
            '{{%chassis_locations}}',
            'chassis_termination',
            '{{%location}}',
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
        $this->dropTable('{{%chassis_locations}}');
        $this->dropForeignKey(
            '{{%chassis_locations_load_id_fk_load}}',
            '{{%chassis_locations}}'
        );
        $this->dropForeignKey(
            '{{%chassis_locations_chassis_pickup_fk_location}}',
            '{{%chassis_locations}}'
        );
        $this->dropForeignKey(
            '{{%chassis_locations_chassis_termination_fk_location}}',
            '{{%chassis_locations}}'
        );
    }
}
