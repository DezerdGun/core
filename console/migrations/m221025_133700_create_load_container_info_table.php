<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%container_info}}`.
 */
class m221025_133700_create_load_container_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%load_container_info}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer(),
            'number' => $this->integer(),
            'size' => $this->string(32),
            'type' => $this->string(32),
            'owner' => $this->integer(),
            'vessel_name' => $this->string(32),
            'mbl' => $this->string(32),
            'hbl' => $this->string(32),
        ]);

        $this->addForeignKey(
            '{{%load_container_info_load_id_fk_load}}',
            '{{%load_container_info}}',
            'load_id',
            '{{%load}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%load_container_info_owner_fk}}',
            '{{%load_container_info}}',
            'owner',
            '{{%owner}}',
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
        $this->dropTable('{{%container_info}}');
        $this->dropForeignKey(
            'load_container_info_load_id_fk_load',
            'load_container_info'
        );
        $this->dropForeignKey(
            'load_container_info_owner_fk',
            'load_container_info'
        );
    }
}
