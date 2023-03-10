<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%column_load_container_info}}`.
 */
class m230307_164317_drop_column_load_container_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{load_additional_info}}','overweight_description',$this->string(255));
        $this->dropColumn('{{load_additional_info}}','temp_in_f');
        $this->addColumn('{{load_additional_info}}','reefer_description',$this->string(255));
        $this->dropColumn('{{%load_container_info}}','load_reference_number');
        $this->addColumn('{{%load}}','load_reference_number',$this->integer(32));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{load_additional_info}}','overweight_description');
        $this->addColumn('{{load_additional_info}}','temp_in_f' ,$this->string(255));
        $this->dropColumn('{{load_additional_info}}','reefer_description');
        $this->addColumn('{{%load_container_info}}','load_reference_number',$this->integer(32));
        $this->dropColumn('{{%load}}','load_reference_number');

    }
}
