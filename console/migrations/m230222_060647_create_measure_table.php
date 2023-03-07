<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%measure}}`.
 */
class m230222_060647_create_measure_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%measure}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->batchInsert('measure', ['name'],
        [
            ['PERHOUR'],
            ['PERDAY'],
            ['PERMILES'],
            ['PERPOUNDS'],
            ['FIXED'],
            ['PERCENTAGE'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%measure}}');
    }
}
