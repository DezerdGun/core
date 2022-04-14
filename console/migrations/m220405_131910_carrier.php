<?php

use yii\db\Migration;

/**
 * Class m220405_131910_carrier
 */
class m220405_131910_carrier extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%carrier}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32),
            'email' => $this->string(32),
            'phone' => $this->string(32),
            'number' => $this->string(32),
            'password' => $this->string(32),
            'mc' => $this->string(32),
            'dot' => $this->string(32),
            'ein' => $this->string(32),
            'w9' => $this->string(32),
            'ic' => $this->string(32),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' =>$this->smallInteger()->notNull()->defaultValue(0),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%carrier}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220405_131910_carrier cannot be reverted.\n";

        return false;
    }
    */
}
