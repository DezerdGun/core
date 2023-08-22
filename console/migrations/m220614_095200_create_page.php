<?php

use yii\db\Migration;

/**
 * Class m220614_095200_create_page
 */
class m220614_095200_create_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{page}}',[
            'id' => $this->primaryKey(),
            'page' => $this->string(32),
            'block' => $this->string(32),
            'text' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220614_095200_create_page cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220614_095200_create_page cannot be reverted.\n";

        return false;
    }
    */
}
