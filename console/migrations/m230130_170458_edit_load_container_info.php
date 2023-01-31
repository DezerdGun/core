<?php

use yii\db\Migration;

/**
 * Class m230130_170458_edit_load_container_info
 */
class m230130_170458_edit_load_container_info extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%load_container_info}}','type');
        $this->addColumn('{{load_container_info}}','type',$this->string(32));
        $this->addForeignKey(
            '{{%load_container_info_type_fk_container}}',
            '{{%load_container_info}}',
            'type',
            '{{%container}}',
            'code',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230130_170458_edit_load_container_info cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230130_170458_edit_load_container_info cannot be reverted.\n";

        return false;
    }
    */
}
