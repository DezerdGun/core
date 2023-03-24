<?php

use yii\db\Migration;

/**
 * Class m230314_093258_alter_load_and_ordinary_load_tables
 */
class m230314_093258_alter_load_and_ordinary_load_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('load', ['status' => 'LOWER(status)']);
        $this->update('ordinary_load', ['status' => 'LOWER(status)']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230314_093258_alter_load_and_ordinary_load_tables cannot be reverted.\n";

        return false;
    }

}
