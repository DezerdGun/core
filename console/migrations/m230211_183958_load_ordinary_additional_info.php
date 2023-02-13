<?php

use yii\db\Migration;

/**
 * Class m230211_183958_load_ordinary_additional_info
 */
class m230211_183958_load_ordinary_additional_info extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%load_ordinary_additional_info}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer(),
            'hazmat' => $this->string(),
            'hazmat_description' => $this->string(),
            'overweight' => $this->string(),
            'overweight_description' => $this->string(),
            'weight_in_LBs' => $this->string(),
            'weight_in_LBs_description' => $this->string(),
            'reefer' => $this->string(),
            'reefer_description' => $this->string(),
            'alcohol' => $this->string(),
            'alcohol_description' => $this->string(),
            'urgent' => $this->string(),
            'urgent_description' => $this->string(),
            'note' => $this->text(),
        ]);

        $this->addColumn('{{ordinary_load}}','status',$this->string(32));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230211_183958_load_ordinary_additional_info cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230211_183958_load_ordinary_additional_info cannot be reverted.\n";

        return false;
    }
    */
}
