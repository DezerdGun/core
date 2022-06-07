<?php

use yii\db\Migration;

/**
 * Class m220603_100117_truck_types
 */
class m220603_100117_truck_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{truck}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(32)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220603_100117_truck_types cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220603_100117_truck_types cannot be reverted.\n";

        return false;
    }
    */
}
