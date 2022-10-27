<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%load_additional_info}}`.
 */
class m221025_153015_create_load_additional_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%load_additional_info}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer(),
            'hazmat' => $this->string(132),
            'overweight' => $this->string(132),
            'reefer' => $this->string(32),
            'alcohol' => $this->string(32),
            'urgent' => $this->string(32),
            'note_from_broker' => $this->text(),
        ]);

        $this->addForeignKey(
            '{{%load_additional_info_load_id_fk_load}}',
            '{{%load_additional_info}}',
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
        $this->dropTable('{{%load_additional_info}}');
        //Добавляем удаление внешнего ключа
        $this->dropForeignKey(
            'load_additional_info_load_id_fk_load',
            'load_additional_info'
        );
    }
}
