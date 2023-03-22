<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ordinary_holds_history}}`.
 */
class m230320_160814_create_ordinary_holds_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ordinary_holds_history}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('LOCALTIMESTAMP'),
            'note_from_customer_and_broker' => $this->text()
        ]);
        $this->addForeignKey(
            '{{%ordinary_holds_history_load_id_fk_ordinary_load}}',
            '{{%ordinary_holds_history}}',
            'load_id',
            '{{%ordinary_load}}',
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
        $this->dropForeignKey(
            '{{%ordinary_holds_history_load_id_fk_ordinary_load}}',
            '{{%ordinary_holds_history}}'
        );
        $this->dropTable('{{%ordinary_holds_history}}');

    }
}
