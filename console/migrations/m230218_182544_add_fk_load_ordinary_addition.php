<?php

use yii\db\Migration;

/**
 * Class m230218_182544_add_fk_load_ordinary_addition
 */
class m230218_182544_add_fk_load_ordinary_addition extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            '{{%load_ordinary_additional_info_load_id_fk_load}}',
            '{{%load_ordinary_additional_info}}',
            'load_id',
            '{{%ordinary_load}}',
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
        $this->dropForeignKey(
            '{{%load_ordinary_additional_info_load_id_fk_load}}',
            '{{%load_ordinary_additional_info}}'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230218_182544_add_fk_load_ordinary_addition cannot be reverted.\n";

        return false;
    }
    */
}
