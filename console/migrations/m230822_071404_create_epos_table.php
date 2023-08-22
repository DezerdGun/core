<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%epos}}`.
 */
class m230822_071404_create_epos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%epos}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(250),
            'specification' => $this->string(250),
            'sort' => $this->integer(10.0),
            'merchant' => $this->string(255),
            'terminal' => $this->string(255),
            'port' => $this->string(255),
            'processing' => $this->integer(10.0),
            'auto_reco' => $this->integer(1.0),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%epos}}');
    }
}
