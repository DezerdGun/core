<?php

use yii\db\Migration;

/**
 * Class m220603_091956_create_type_load
 */
class m220603_091956_create_type_load extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{load}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(32)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220603_091956_create_type_load cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220603_091956_create_type_load cannot be reverted.\n";

        return false;
    }
    */
}
