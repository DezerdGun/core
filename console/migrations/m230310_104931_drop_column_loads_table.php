<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%column_loads}}`.
 */
class m230310_104931_drop_column_loads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%load_additional_info}}','weight_in_lbs');
        $this->dropColumn('{{%load_ordinary_additional_info}}','weight_in_LBs');
        $this->renameColumn('load_additional_info', 'note_from_broker','note');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%load_container_info}}','weight_in_lbs',$this->string(255));
        $this->addColumn('{{%load_ordinary_additional_info}}','weight_in_LBs',$this->integer());
        $this->renameColumn('load_container_info', 'note','note_from_broker');
    }
}
