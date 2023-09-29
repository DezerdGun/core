<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bank_card_type_processes}}`.
 */
class m230920_103312_create_bank_card_type_processes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bank_card_type_processes}}', [
          'id' => $this->primaryKey(),
          'name' => $this->string('250'),
          'created_at' => $this->timestamp(),
          'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bank_card_type_processes}}');
    }
}
