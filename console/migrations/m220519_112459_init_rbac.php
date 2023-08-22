<?php

use yii\db\Migration;

/**
 * Class m220519_112459_init_rbac
 */
class m220519_112459_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }
    public function up()
    {
        $auth = Yii::$app->authManager;

        // Добавляем доступ на создание постов
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // Добавляем доступ на обновление постов
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // добавьте роль author и предоставьте этой роли разрешение createPost
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        // добавить роль «admin» и даем этой роли разрешение «updatePost»
        // а также все права роли «author»
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        // Задаем пользователю с id=1 роль администратора
        $auth->assign($admin, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220519_112459_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220519_112459_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
