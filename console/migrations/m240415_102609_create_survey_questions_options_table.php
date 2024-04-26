<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%survey}}`.
 */
class m240415_102609_create_survey_questions_options_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%survey}}', [
            'id' => $this->primaryKey(),
            'title_ru' => $this->string(250),
            'title_uz' => $this->string(250),
            'title_en' => $this->string(250),
            'state' => $this->string(10)->notNull()->defaultValue('inactive'),
            'create_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'update_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'deleted_at' => $this->timestamp()->null(),
        ]);

        $this->createTable('{{%survey_questions}}', [
            'id' => $this->primaryKey(),
            'survey_id' => $this->integer()->notNull(),
            'text_ru' => $this->string(250),
            'text_uz' => $this->string(250),
            'text_en' => $this->string(250),
            'subtext_ru' => $this->string(250),
            'subtext_uz' => $this->string(250),
            'subtext_en' => $this->string(250),
            'type' => $this->string(15)->notNull(),
            'sort_order' => $this->integer()->defaultValue(500),
            'create_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'update_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'deleted_at' => $this->timestamp()->null(),
        ]);
        $this->createTable('{{%survey_options}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'text_ru' => $this->string(250),
            'text_uz' => $this->string(250),
            'text_en' => $this->string(250),
            'subtext_ru' => $this->string(250),
            'subtext_uz' => $this->string(250),
            'subtext_en' => $this->string(250),
            'type' => $this->string(10)->notNull(),
            'create_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'update_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'deleted_at' => $this->timestamp()->null(),
        ]);
        $this->createIndex('idx-survey-state', '{{%survey}}', 'state');
        $this->createIndex('idx-survey-questions-survey-id', '{{%survey_questions}}', 'survey_id');
        $this->createIndex('idx-survey-options-question-id', '{{%survey_options}}', 'question_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%survey}}');
        $this->dropTable('{{%survey_questions}}');
        $this->dropTable('{{%survey_options}}');
    }
}
