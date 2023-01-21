<?php

use yii\db\Migration;

/**
 * Class m230120_113358_edit_ordinary_load_table
 */
class m230120_113358_edit_ordinary_load_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%ordinary_load}}','destination','destination_id');
        $this->renameColumn('{{%ordinary_load}}','origin','origin_id');
        $this->renameColumn('{{%ordinary_load}}','equipment_need','equipment_need_id');
        $this->addColumn('ordinary_load','user_id',$this->integer()->notNull());

        $this->addForeignKey(
            '{{%ordinary_load_user_id_fk}}',
            '{{%ordinary_load}}',
            'user_id',
            '{{%user}}',
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
        echo "m230120_113358_edit_ordinary_load_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230120_113358_edit_ordinary_load_table cannot be reverted.\n";

        return false;
    }
    */
}
