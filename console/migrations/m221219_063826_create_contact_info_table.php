<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact_info}}`.
 */
class m221219_063826_create_contact_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact_info}}', [
            'id' => $this->primaryKey(),
            'main_phone_number' => $this->string(32),
            'additional_phone_number' => $this->string(32),
            'main_email' => $this->string(32),
            'additional_email' => $this->string(32),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contact_info}}');
    }
}
