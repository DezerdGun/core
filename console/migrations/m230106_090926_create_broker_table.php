<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%broker}}`.
 */
class m230106_090926_create_broker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%broker}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'master_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-broker_user_id',
            'broker',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-broker_master_id',
            'broker',
            'master_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%broker}}');
    }
}
