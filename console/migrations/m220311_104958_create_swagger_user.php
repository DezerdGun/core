<?php

use yii\db\Migration;

/**
 * Class m220311_104958_create_swagger_user
 */
class m220311_104958_create_swagger_user extends Migration
{
    protected $clientId = 'sf6KKGAhlW-VVkfjTdQCZqB5U5iyZxCf';
    protected $clientSecret = 'XBwabfg48Voh0MHBRYGsVgIkA03mvF7B';
    protected $email = 'swagger@jafton.com';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $time = time();
        $this->insert('{{%user}}', [
            'username' => 'swagger',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('k5m8NJ2m-dOWHHTX9dwE6mbz6hRy7Cix'),
            'email' => $this->email,
            'status' => common\models\User::STATUS_ACTIVE,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $this->insert('{{%oauth_clients}}', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => 'oob',
            'grant_types' => common\enums\GrantType::PASSWORD,
            'scope' => common\enums\Scope::USER,
            'user_id' => \common\models\User::findOne(['email' => $this->email])->id
        ]);
        $this->insert('{{%user}}', [
            'username' => 'Admin',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('chesnok'),
            'email' => 'admin@jafton.com',
            'status' => common\models\User::STATUS_ACTIVE,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%oauth_clients}}', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret
        ]);
        $this->delete('{{%user}}', ['email' => $this->email]);
    }

}
