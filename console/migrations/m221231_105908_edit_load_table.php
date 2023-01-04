<?php

use yii\db\Migration;

/**
 * Class m221231_105908_edit_load_table
 */
class m221231_105908_edit_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('load', 'broker_name');
        $this->dropColumn('load', 'load_status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('load', 'broker_name');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221231_105908_edit_load_table cannot be reverted.\n";

        return false;
    }
    */
}
