<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "survey".
 *
 * @property int $id
 * @property string|null $title_ru
 * @property string|null $title_uz
 * @property string|null $title_en
 * @property string $state
 * @property string|null $create_at
 * @property string|null $update_at
 * @property string|null $deleted_at
 */
class Survey extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'survey';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_at', 'update_at', 'deleted_at'], 'safe'],
            [['title_ru', 'title_uz', 'title_en'], 'string', 'max' => 250],
            [['state'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_ru' => 'Title Ru',
            'title_uz' => 'Title Uz',
            'title_en' => 'Title En',
            'state' => 'State',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
