<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%load_status}}`.
 */
class m230123_180227_drop_load_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%load_status}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%load_status}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
