<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%load_ordinary_reference_number}}`.
 */
class m230222_042821_create_load_ordinary_reference_number_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%load_ordinary_reference_number}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer()->notNull(),
            'seal' => $this->string(32),
            'pick_up' => $this->string(32),
            'appointment' => $this->string(32),
            'reservation' => $this->string(32),
        ]);
        $this->addForeignKey(
            '{{%load_ordinary_reference_number_load_id_fk_load}}',
            '{{%load_ordinary_reference_number}}',
            'load_id',
            '{{%load}}',
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
        $this->dropTable('{{%load_ordinary_reference_number}}');
        $this->dropForeignKey(
            '{{%load_ordinary_reference_number_load_id_fk_load}}',
            '{{%load_ordinary_reference_number}}'
        );
    }
}
