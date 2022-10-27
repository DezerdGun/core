<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%container_owner_name}}`.
 */
class m221025_133503_create_list_container_owner_name_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%owner}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull()
        ]);
        $owner = [
            'NSA',
            'MATSON',
            'EIMSKIP',
            'CROWLEY',
            'CULL',
            'BERMUDA',
            'BAL',
            'SML',
            'ZIM',
            'YANGMING',
            'WAN HAI',
            'TURKON',
            'SEABOARD',
            'HYUNDAI',
            'HAMBURG',
            'ANL',
            'ACL',
            'OOCL',
            'ONE',
            'COSCO',
            'APL',
            'HAPAG',
            'MSC',
            'MAERSK',
            'CMA-CGM',
            'EVERGREEN',
            'KS LOGISTICS LLC'
        ];
        foreach ($owner as $item){
            $model = new \common\models\Owner();
            $model->name = $item;
            $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%container_owner_name}}');
    }
}
