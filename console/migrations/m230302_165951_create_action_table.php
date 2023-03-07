<?php

use yii\db\Migration;
use common\enums\Action;

/**
 * Handles the creation of table `{{%action}}`.
 */
class m230302_165951_create_action_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%action}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'description' => $this->string(200)
        ]);
        $this->insert('{{%action}}',
            ['name' => Action::CONTAINER_BID_EDIT, 'description' => 'Container bid editing bids'],
            ['name' => Action::ORDINARY_BID_EDIT, 'description' => 'Ordinary bid editing']
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%action}}');
    }
}
