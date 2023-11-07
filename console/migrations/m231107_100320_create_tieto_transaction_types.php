<?php

use yii\db\Migration;

/**
 * Class m231107_100320_create_tieto_transaction_types
 */
class m231107_100320_create_tieto_transaction_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('TIETO_TRANSACTION_TYPES', [
        'id' => $this->primaryKey(),
        'code' => $this->string(250)->notNull(),
        'name_uz' => $this->string(250)->null(),
        'name_ru' => $this->string(250)->null(),
        'name_en' => $this->string(250)->null(),
        'specification' => $this->string(250)->null(),
        'type' => $this->string(50)->null(),
        'sort' => $this->integer()->defaultValue(100)->notNull(),
        'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
      ]);

      $this->createIndex('INDEX_TIETO_TRANSACTION_TYPES_CODE', 'TIETO_TRANSACTION_TYPES', 'code');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropTable('TIETO_TRANSACTION_TYPES');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231107_100320_create_tieto_transaction_types cannot be reverted.\n";

        return false;
    }
    */
}
