<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%date}}`.
 */
class m230130_153624_create_date_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%date}}', [
            'id' => $this->primaryKey(),
            'vessel_eta' => $this->date(),
            'last_free_day' => $this->date(),
            'discharged_date' => $this->date(),
            'outgate_date' => $this->date(),
            'empty_date' => $this->date(),
            'ingate_ate' => $this->date(),
        ]);

        $this->addForeignKey(
            '{{%date_load_fk}}',
            '{{%load}}',
            'vessel_eta',
            '{{%date}}',
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
        $this->dropTable('{{%date}}');
    }
}
