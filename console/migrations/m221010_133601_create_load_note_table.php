<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%load_note}}`.
 */
class m221010_133601_create_load_note_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%load_note}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('LOCALTIMESTAMP'),
            'notes' => $this->text()

        ]);

        $this->addForeignKey(
            '{{%load_note_load_id_fk}}',
            '{{%load_note}}',
            'load_id',
            '{{%load_bid}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%load_note_created_by_fk}}',
            '{{%load_note}}',
            'created_by',
            '{{%user}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%load_note}}');
    }
}
