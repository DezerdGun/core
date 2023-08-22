<?php

use yii\db\Migration;

/**
 * Class m230223_194435_add_column_load_container_info_table
 */
class m230223_194435_add_column_load_container_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%load_container_info}}','chassis',$this->string(32));
        $this->addColumn('{{%load_container_info}}','chassis_type',$this->string(32));
        $this->addColumn('{{%load_container_info}}','chassis_size',$this->integer(32));
        $this->addColumn('{{%load_container_info}}','chassis_owner_id',$this->integer());
        $this->addColumn('{{%load_container_info}}','chassis_genset',$this->string(32));
        $this->addForeignKey(
            '{{%load_container_info_chassis_type_fk_container}}',
            '{{%load_container_info}}',
            'chassis_type',
            '{{%container}}',
            'code',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            '{{%load_container_info_chassis_owner_id_fk_owner}}',
            '{{%load_container_info}}',
            'chassis_owner_id',
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
        $this->dropColumn('{{%load_container_info}}','chassis');
        $this->dropColumn('{{%load_container_info}}','chassis_type');
        $this->dropColumn('{{%load_container_info}}','chassis_size');
        $this->dropColumn('{{%load_container_info}}','chassis_owner_id');
        $this->dropColumn('{{%load_container_info}}','chassis_genset');
        $this->dropForeignKey(
            '{{%load_container_info_chassis_type_fk_container}}',
            '{{%load_container_info}}'
        );
        $this->dropForeignKey(
            '{{%load_container_info_chassis_owner_id_fk_owner}}',
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
        echo "m230223_194435_add_column_load_container_info_table cannot be reverted.\n";

        return false;
    }
    */
}
