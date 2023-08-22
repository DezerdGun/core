<?php

use yii\db\Migration;

/**
 * Class m230315_171038_add_column_ordinary_load_description_table
 */
class m230315_171038_add_column_ordinary_load_description_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%load_ordinary_description}}', 'genset' ,$this->string(32));
        $this->addColumn('{{%date}}', 'load_id' ,$this->integer());
        $this->addForeignKey(
            '{{%date_fk_to_load}}',
            '{{%date}}',
            'load_id',
            '{{%load}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%load_ordinary_description}}', 'genset');
        $this->dropColumn('{{%date}}', 'load_id' );
        $this->dropForeignKey(
            '{{%date_fk_to_load}}',
            '{{%date}}'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230315_171038_add_column_ordinary_load_description_table cannot be reverted.\n";

        return false;
    }
    */
}
