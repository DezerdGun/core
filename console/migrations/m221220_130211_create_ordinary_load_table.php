<?php

use yii\db\Migration;

/**
 * Class m221220_130211_create_ordinary_load
 */
class m221220_130211_create_ordinary_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ordinary_load}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'origin' => $this->integer(),
            'destination' => $this->integer(),
            'equipment_need' => $this->integer(),
            'pick_up_date' =>  $this->timestamp()->notNull()->defaultExpression('LOCALTIMESTAMP'),
        ]);

        $this->addForeignKey(
            '{{%load_customer_id_fk}}',
            '{{%ordinary_load}}',
            'customer_id',
            '{{%company}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%load_origin_fk}}',
            '{{%ordinary_load}}',
            'origin',
            '{{%location}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%load_destination_fk}}',
            '{{%ordinary_load}}',
            'destination',
            '{{%location}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            '{{%load_equipment_needed_fk}}',
            '{{%ordinary_load}}',
            'equipment_need',
            '{{%ordinary_needed}}',
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
        echo "m221220_130211_create_ordinary_load cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221220_130211_create_ordinary_load cannot be reverted.\n";

        return false;
    }
    */
}
