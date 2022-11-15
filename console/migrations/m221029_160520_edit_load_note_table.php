<?php

use yii\db\Migration;

/**
 * Class m221029_160520_edit_load_note_table
 */
class m221029_160520_edit_load_note_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%load_note}}');
        $this->createTable('{{%load_note}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('LOCALTIMESTAMP'),
            'note_from_carrier' => $this->text()

        ]);

        $this->addForeignKey(
            '{{%load_note_load_id_fk}}',
            '{{%load_note}}',
            'load_id',
            '{{%load_bid}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%load_note_created_by_fk}}',
            '{{%load_note}}',
            'created_by',
            '{{%user}}',
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
        echo "m221029_160520_edit_load_note_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221029_160520_edit_load_note_table cannot be reverted.\n";

        return false;
    }
    */
}
