<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "TIETO_TRANSACTION_TYPES".
 *
 * @property int $id
 * @property string $code
 * @property string|null $name_uz
 * @property string|null $name_ru
 * @property string|null $name_en
 * @property string|null $specification
 * @property string|null $type
 * @property int $sort
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TietoTransactionTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TIETO_TRANSACTION_TYPES';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['sort'], 'default', 'value' => null],
            [['sort'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code', 'name_uz', 'name_ru', 'name_en', 'specification'], 'string', 'max' => 250],
            [['type'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name_uz' => 'Name Uz',
            'name_ru' => 'Name Ru',
            'name_en' => 'Name En',
            'specification' => 'Specification',
            'type' => 'Type',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
