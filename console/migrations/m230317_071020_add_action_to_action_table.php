<?php

use common\enums\Action;
use yii\db\Migration;

/**
 * Class m230317_071020_add_action_to_action_table
 */
class m230317_071020_add_action_to_action_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%action}}',
            ['name' => Action::ORDINARY_BID_EDIT, 'description' => 'Ordinary bid editing']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%action}}', ['name' => Action::ORDINARY_BID_EDIT]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230317_071020_add_action_to_action_table cannot be reverted.\n";

        return false;
    }
    */
}
