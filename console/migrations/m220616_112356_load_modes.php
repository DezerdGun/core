<?php

use common\models\load_modes;
use yii\db\Migration;

/**
 * Class m220616_112356_load_modes
 */
class m220616_112356_load_modes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{load_modes}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $container = [
            "Truck Load",
            "Less Than Truck Load",
            "Intermodal",
            "Partial",
            "Drayage",
            "Parcel",
            "Air",
            "Water",
            "Ocean",
        ];
        foreach ($container as $item){
            $model = new load_modes();
            $model->name = $item;
            $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220616_112356_load_modes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220616_112356_load_modes cannot be reverted.\n";

        return false;
    }
    */
}
