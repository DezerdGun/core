<?php

use yii\db\Migration;

/**
 * Class m230216_073325_edit_load_container_info_table
 */
class m230216_073325_edit_load_container_info_table extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%load_container_info}}','owner');
        $this->addColumn('{{load_container_info}}','owner_id',$this->integer(12));
        $this->addForeignKey(
            '{{%load_container_info_owner_id_fk_container}}',
            '{{%load_container_info}}',
            'owner_id',
            '{{%owner}}',
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
        $this->dropColumn('{{load_container_info}}','owner_id');
        $this->dropForeignKey(
            '{{%load_container_info_owner_id_fk_container}}',
            '{{%load_container_info}}'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230216_073325_edit_load_container_info_table cannot be reverted.\n";

        return false;
    }
    */
}
