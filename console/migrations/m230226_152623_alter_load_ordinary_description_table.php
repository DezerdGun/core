<?php

use yii\db\Migration;

/**
 * Class m230226_152623_alter_load_ordinary_description_table
 */
class m230226_152623_alter_load_ordinary_description_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%load_ordinary_description}}', 'pieces');
        $this->dropColumn('{{%load_ordinary_description}}', 'commodity');
        $this->dropColumn('{{%load_ordinary_description}}', 'description');
        $this->dropColumn('{{%load_ordinary_description}}', 'weight_KGs');
        $this->addColumn('load_ordinary_description', 'pallet_size', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('load_ordinary_description', 'pallet_size');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230226_152623_alter_load_ordinary_description_table cannot be reverted.\n";

        return false;
    }
    */
}
