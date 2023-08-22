<?php

use yii\db\Migration;

/**
 * Class m230206_054332_alter_container_info_table
 */
class m230206_054332_alter_container_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('listing_container_info', 'size');
        $this->dropColumn('load_container_info', 'size');
        $this->addColumn('listing_container_info', 'size', $this->integer());
        $this->addColumn('load_container_info', 'size', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('listing_container_info', 'size');
        $this->dropColumn('load_container_info', 'size');
        $this->addColumn('listing_container_info', 'size', $this->string());
        $this->addColumn('load_container_info', 'size', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230206_054332_alter_container_info_table cannot be reverted.\n";

        return false;
    }
    */
}
