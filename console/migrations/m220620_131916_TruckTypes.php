<?php

use yii\db\Migration;

/**
 * Class m220620_131916_TruckTypes
 */
class m220620_131916_TruckTypes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{truck_types}}', [
            'code' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
        ]);

        $this->addPrimaryKey('truck_types_pk', 'truck_types', ['code']);

        $container = [
            'V' => 'Vans Standard',
            'F' => 'Flatbeds',
            'R' => 'Reefers' ,
            'N' => 'Conestoga' ,
            'C' => 'Containers',
            'K' => 'Decks Specialized' ,
            'D' => 'Decks Standard'  ,
            'B' => 'Dry Bulk'  ,
            'Z' => 'Hazardous Materials',
            'O' => 'Other Equipment',
            'T' => 'Tankers',
            'S' => 'Vans, Specialized',
        ];

        foreach ($container as $stateCode => $state) {
            $model = new \common\models\TruckTypes();
            $model->code = $stateCode;
            $model->name = $state;
            $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220620_131916_TruckTypes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220620_131916_TruckTypes cannot be reverted.\n";

        return false;
    }
    */
}
