<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%container_return}}`.
 */
class m230223_154404_create_container_return_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%container_return}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer(),
            'container_return' => $this->integer(),
            'return_from' => $this->timestamp()->notNull()->defaultExpression('LOCALTIMESTAMP'),
            'return_to' => $this->timestamp()->notNull()->defaultExpression('LOCALTIMESTAMP'),
        ]);
        $this->addForeignKey(
            '{{%container_return_load_id_fk_load}}',
            '{{%container_return}}',
            'load_id',
            '{{%load}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%container_return_container_return_fk_location}}',
            '{{%container_return}}',
            'container_return',
            '{{%location}}',
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
        $this->dropTable('{{%container_return}}');
        $this->dropForeignKey(
            '{{%container_return_load_id_fk_load}}',
            '{{%container_return}}'
        );
        $this->dropForeignKey(
            '{{%container_return_container_return_fk_load}}',
            '{{%container_return}}'
        );
    }
}
