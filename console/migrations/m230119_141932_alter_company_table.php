<?php

use yii\db\Migration;

/**
 * Class m230119_141932_alter_company_table
 */
class m230119_141932_alter_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand('ALTER TABLE company DROP CONSTRAINT company_company_name_key')->execute();
        Yii::$app->db->createCommand('ALTER TABLE company DROP CONSTRAINT company_dot_key')->execute();
        Yii::$app->db->createCommand('ALTER TABLE company DROP CONSTRAINT company_mc_number_key')->execute();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%company}}', 'mc_number');
        $this->alterColumn('{{%company}}', 'dot');
        $this->alterColumn('{{%company}}', 'company_name');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230119_141932_alter_company_table cannot be reverted.\n";

        return false;
    }
    */
}
