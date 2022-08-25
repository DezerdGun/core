<?php

use yii\db\Migration;

/**
 * Class m220824_093705_alter_load_stop_column
 */
class m220824_093705_alter_load_stop_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%load_stop}}', 'from', $this->dateTime());
        $this->dropColumn('{{%load_stop}}', 'to', $this->dateTime());
        $this->addColumn('{{%load_stop}}', 'from', $this->timestamp());
        $this->addColumn('{{%load_stop}}', 'to', $this->timestamp());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220824_093705_alter_load_stop_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220824_093705_alter_load_stop_column cannot be reverted.\n";

        return false;
    }
    */
}
