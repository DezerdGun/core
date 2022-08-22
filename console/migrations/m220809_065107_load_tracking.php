<?php

use yii\db\Migration;

/**
 * Class m220809_065107_load_tracking
 */
class m220809_065107_load_tracking extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("{{load_tracking}}",[
            'id' => $this->primaryKey(),
            'load_id' => $this->integer(),
            'created' => $this->timestamp(),
            'lat' => $this->float(),
            'long' => $this->float(),
        ]);

        $this->addForeignKey(
            '{{%load_tracking_id_fk}}',
            '{{%load_tracking}}',
            'load_id',
            '{{%load}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220809_065107_load_tracking cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220809_065107_load_tracking cannot be reverted.\n";

        return false;
    }
    */
}
