<?php

use common\models\Container;
use yii\db\Migration;

/**
 * Class m220519_082850_container
 */
class m220519_082850_container extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%container}}',[
            'code' => $this->string(4)->notNull(),
            'name' => $this->string()->notNull(),
        ]);
        $this->addPrimaryKey('code','{{%container}}','code');

        $container = [
            '20GP' => '20FT GENERAL PURPOSE',
            '20HR' => '20FT INSULATED',
            '20PF' => '20FT FLAT (FIXED ENDS)',
            '20TD' => '20FT TANK',
            '20TG' => '20FT TANK',
            '20TN' => '20FT TANK',
        ];

        foreach ($container as $stateCode => $state) {
            $model = new Container();
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
        $this->dropTable('{{%container}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220519_082850_container cannot be reverted.\n";

        return false;
    }
    */
}
