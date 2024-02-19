<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%link_provider}}`.
 */
class m240219_050720_create_links_table extends Migration
{
  public function safeUp()
  {
    $this->createTable('{{%link_provider}}', [
      'id' => $this->primaryKey(),
      'type' => $this->string(20)->notNull(),
      'url' => $this->string(255)->notNull(),
      'status' => $this->string(10)->defaultValue('inactive')->comment('Status'),
      'created_at' => $this->integer()->notNull(),
    ]);
    
    $this->execute("ALTER TABLE {{%link_provider}} ADD CHECK (type IN ('app-store', 'play-market'))");
    $this->execute("ALTER TABLE {{%link_provider}} ADD CHECK (status IN ('active', 'inactive', 'deleted'))");
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    $this->dropTable('{{%link_provider}}');
  }
}
