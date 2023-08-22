<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ordinary_needed}}`.
 */
class m221220_050116_create_ordinary_needed_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ordinary_needed}}', [
            'id' => $this->primaryKey(),
            'ordinary_need' => $this->string(),
        ]);
//
//        $this->addForeignKey(
//            '{{%load_equipment_needed_fk}}',
//            '{{%ordinary_needed}}',
//            'ordinary_need',
//            '{{%equipment}}',
//            'code',
//            'CASCADE',
//            'CASCADE'
//        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ordinary_needed}}');
    }
}
