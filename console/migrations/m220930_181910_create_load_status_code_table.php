<?php

use common\models\LoadStatus;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%load_status_code}}`.
 */
class m220930_181910_create_load_status_code_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%load_status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull()
        ]);
        $loadstatus = [
            "PENDING",
            "AVAILABLE",
            "DEPARTED",
            "DISPATCHED",
            "CHASSISPICK_ARRIVED",
            "CHASSISPICK_DEPARTED",
            "PULLCONTAINER_ARRIVED",
            "PULLCONTAINER_DEPARTED",
            "DELIVERLOAD_ARRIVED",
            "DELIVERLOAD_DEPARTED",
            "DROPCONTAINER_ARRIVED",
            "DROPCONTAINER_DEPARTED",
            "HOOKCONTAINER_ARRIVED",
            "HOOKCONTAINER_DEPARTED",
            "RETURNCONTAINER_ARRIVED",
            "RETURNCONTAINER_DEPARTED",
            "CHASSISTERMINATION_ARRIVED",
            "CHASSISTERMINATION_DEPARTED",
            "COMPLETED",
            "APPROVED",
            "BILLING",
            "UNAPPROVED",
            "REBILLING",
            "PARTIAL_PAID",
            "FULL_PAID",
        ];
        foreach ($loadstatus as $item){
            $model = new LoadStatus();
            $model->name = $item;
            $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%load_status_code}}');
    }
}
