<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m230106_090854_add_user_table
 */
class m230106_090854_update_user_table extends Migration
{
    protected $clientId = 'sf6KKGAhlW-VVkfjTdQCZqB5U5iyZxCf';
    protected $clientSecret = 'XBwabfg48Voh0MHBRYGsVgIkA03mvF7B';
    protected $email = 'swagger@jafton.com';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role', $this->string(32));
        $this->update('user', ['role' => 'Master broker'], ['id' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{user}}');
    }

/*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230106_090854_add_user_table cannot be reverted.\n";

        return false;
    }
*/

}
