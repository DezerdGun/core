<?php

use yii\db\Migration;

/**
 * Class m230303_163514_add_column_ordinary_needed_table
 */
class m230303_163514_add_column_ordinary_needed_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropColumn('{{%ordinary_load}}', 'equipment_need_id' );
        $this->addColumn('{{%ordinary_needed}}', 'equipment_needed_id' ,$this->integer());
        $this->addForeignKey(
            '{{%ordinary_equipment_need_id_fk}}',
            '{{%ordinary_needed}}',
            'equipment_needed_id',
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
        $this->addColumn('{{%ordinary_load}}', 'equipment_need_id',$this->integer());
        $this->dropColumn('{{%ordinary_needed}}', 'equipment_needed_id' );
        $this->dropForeignKey(
            '{{%ordinary_equipment_need_id_fk}}',
            '{{%ordinary_needed}}'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230303_163514_add_column_ordinary_needed_table cannot be reverted.\n";

        return false;
    }
    */
}
