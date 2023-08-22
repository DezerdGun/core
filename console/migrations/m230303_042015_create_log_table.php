<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 */
class m230303_042015_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'action_id' => $this->integer(),
            'action_date' => $this->integer()->notNull(),
            'detail' => $this->string()->notNull()
        ]);
        $this->addForeignKey(
            'fk-log_user_id',
            'log',
            'user_id',
            'user',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-log_user_id',
            'log'
        );

        $this->dropTable('{{%log}}');
    }
}
