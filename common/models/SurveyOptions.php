<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "survey_options".
 *
 * @property int $id
 * @property int $question_id
 * @property string|null $text_ru
 * @property string|null $text_uz
 * @property string|null $text_en
 * @property string|null $subtext_ru
 * @property string|null $subtext_uz
 * @property string|null $subtext_en
 * @property string $type
 * @property string|null $create_at
 * @property string|null $update_at
 * @property string|null $deleted_at
 */
class SurveyOptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'survey_options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'type'], 'required'],
            [['question_id'], 'default', 'value' => null],
            [['question_id'], 'integer'],
            [['create_at', 'update_at', 'deleted_at'], 'safe'],
            [['text_ru', 'text_uz', 'text_en', 'subtext_ru', 'subtext_uz', 'subtext_en'], 'string', 'max' => 250],
            [['type'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'text_ru' => 'Text Ru',
            'text_uz' => 'Text Uz',
            'text_en' => 'Text En',
            'subtext_ru' => 'Subtext Ru',
            'subtext_uz' => 'Subtext Uz',
            'subtext_en' => 'Subtext En',
            'type' => 'Type',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
