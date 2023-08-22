<?php

use yii\db\Migration;

/**
 * Class m220728_193117_address
 */
class m220728_193117_address extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("{{%address}}",[
            'id' => $this->primaryKey(),
            'street_address' => $this->string(32),
            'city' => $this->string(32),
            'state_code' => $this->string(32),
            'zip' => $this->string(32),
            'country' => $this->string(32),
            'lat' => $this->string(32),
            'long' => $this->string(32),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220728_193117_address cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220728_193117_address cannot be reverted.\n";

        return false;
    }
    */
}
