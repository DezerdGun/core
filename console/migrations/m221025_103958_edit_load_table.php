<?php

use yii\db\Migration;

/**
 * Class m221025_103958_edit_load_table
 */
class m221025_103958_edit_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%load}}','load_type');
        $this->dropColumn('{{%load}}','route_type');
        $this->dropColumn('{{%load}}','order');

        $this->addColumn('{{load}}','vessel_eta',$this->timestamp()->notNull()->defaultExpression('LOCALTIMESTAMP'));
        $this->addColumn('{{load}}','broker_name',$this->string('32'));
        $this->addColumn('{{load}}','load_status',$this->integer());

        $this->addForeignKey(
            '{{%load_to_load_status_fk}}',
            '{{%load}}',
            'load_status',
            '{{%load_status}}',
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
        echo "m221025_103958_edit_load_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221025_103958_edit_load_table cannot be reverted.\n";

        return false;
    }
    */
}
