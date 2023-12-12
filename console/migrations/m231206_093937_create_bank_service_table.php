<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bank_service}}`.
 */
class m231206_093937_create_bank_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('{{%bank_services}}', [
        'id' => $this->primaryKey(),
        'code' => $this->string(250),
        'sort' => $this->integer(10)->defaultValue(100)->notNull(),
        'name_ru' => $this->string(255)->notNull(),
        'name_uz' => $this->string(255)->notNull(),
        'name_en' => $this->string(255)->notNull(),
        'icon_id' => $this->integer(10)->notNull(),
        'action' => $this->string(255)->notNull(),
        'is_new' => $this->tinyInteger(1)->defaultValue(0)->notNull(),
        'ignore_custom_order' => $this->tinyInteger(1)->defaultValue(0)->notNull(),
        'ignore_disabled' => $this->tinyInteger(1)->defaultValue(0)->notNull(),
        'platform' => $this->string(255)->defaultValue('all')->notNull(),
        'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        'deleted_at' => $this->timestamp()->null(),
      ]);

      $this->insert('{{%bank_services}}', [
        'code' => 'peer2peer',
        'sort' => 100,
        'name_ru' => 'Перевод с карты на карту',
        'name_uz' => 'Karta dan karta ga pul o`tkazish',
        'name_en' => 'Card to card transfer',
        'icon_id' => 1,
        'action' => 'iym://transfers/p2p',
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bank_service}}');
    }
}
