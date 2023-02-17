<?php

use yii\db\Migration;
use common\models\User;
/**
 * Class m230213_171430_update_broker_table
 */
class m230213_171430_update_broker_table extends Migration
{
    protected $email = 'swagger@jafton.com';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%broker}}', ['user_id' => User::findOne(['email' => $this->email])->id]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%broker}}', ['email' => $this->email]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230213_171430_update_broker_table cannot be reverted.\n";

        return false;
    }
    */
}
