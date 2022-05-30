<?php

use yii\db\Migration;

/**
 * Class m220405_131910_create_carrier_table
 */
class m220405_131910_create_carrier_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%carrier}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->unique(),
            'mc' => $this->string(32),
            'dot' => $this->string(32),
            'ein' => $this->string(32),
            'w9_file' => $this->string(55),
            'w9_mime_type' => $this->string(32),
            'ic_file' => $this->string(55),
            'ic_mime_type' => $this->string(32),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // add foreign key for table 'user'
        $this->addForeignKey(
            'fk-carrier-user_id',
            'carrier',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-carrier-user_id',
            'carrier'
        );

        $this->dropTable('{{%carrier}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220405_131910_carrier cannot be reverted.\n";

        return false;
    }
    */
}
