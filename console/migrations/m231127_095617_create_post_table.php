<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m231127_095617_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
          'id' => $this->primaryKey(),
          'type' => $this->string(255),
          'status' => $this->string(255),
          'category_id' => $this->integer(11),
          'create_at' => $this->integer(11),
          'update_at' => $this->integer(11),
          'view_count' => $this->integer(11),
          'image_id' => $this->integer(11),
          'user_id' => $this->integer(11),
          'options' => $this->string(255),
          'hash' => $this->integer(11),
          'news_category_id' => $this->integer(11),
          'promo_data' => $this->text(),
          'about_main_section_type' => $this->string(250),
          'position_on_parent_list' => $this->integer(11)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
