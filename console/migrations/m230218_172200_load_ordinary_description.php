<?php

use yii\db\Migration;

/**
 * Class m230218_172200_load_ordinary_description
 */
class m230218_172200_load_ordinary_description extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%load_ordinary_description}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer(),
            'commodity' => $this->string(32),
            'description' => $this->string(32),
            'pieces' => $this->integer(32),
            'pallets' => $this->integer(32),
            'weight_KGs' => $this->decimal(3,0),
            'weight_LBs' => $this->decimal(3,0),
        ]);
        $this->addForeignKey(
            '{{%load_ordinary_description_load_id_fk_load}}',
            '{{%load_ordinary_description}}',
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
        $this->dropTable('{{%load_ordinary_description}}');
        $this->dropForeignKey(
            '{{%load_ordinary_description_load_id_fk_load}}',
            '{{%load_ordinary_description}}'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230218_172200_load_ordinary_description cannot be reverted.\n";

        return false;
    }
    */
}
