<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%holds_history}}`.
 */
class m230220_111448_create_holds_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%holds_history}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('LOCALTIMESTAMP'),
            'note_from_customer_and_broker' => $this->text()
        ]);
        $this->addForeignKey(
            '{{%holds_history_load_id_fk_load}}',
            '{{%holds_history}}',
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
        $this->dropTable('{{%holds_history}}');
        $this->dropForeignKey(
            '{{%holds_history_load_id_fk_load}}',
            '{{%holds_history}}'
        );
    }
}
