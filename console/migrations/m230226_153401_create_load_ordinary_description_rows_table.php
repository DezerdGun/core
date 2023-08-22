<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%load_ordinary_description_rows}}`.
 */
class m230226_153401_create_load_ordinary_description_rows_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%load_ordinary_description_rows}}', [
            'id' => $this->primaryKey(),
            'load_ordinary_description_id' => $this->integer(),
            'commodity' => $this->string(32),
            'description' => $this->string(32),
            'pieces' => $this->integer(32),
            'pallets' => $this->string(32),
            'weight_KGs' => $this->decimal(3,2),
            'weight_LBs' => $this->decimal(3,2),
        ]);
        $this->addForeignKey(
            '{{%load_ordinary_description_rows_load_ordinary_description_id_fk_load_ordinary_description}}',
            '{{%load_ordinary_description_rows}}',
            'load_ordinary_description_id',
            '{{%load_ordinary_description}}',
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
        $this->dropTable('{{%load_ordinary_description_rows}}');
        $this->dropForeignKey(
            '{{%load_ordinary_description_rows_load_ordinary_description_id_fk_load_ordinary_description}}',
            '{{%load_ordinary_description_rows}}'
        );
    }
}
