<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bank_services".
 *
 * @property int $id
 * @property string|null $code
 * @property int $sort
 * @property string $name_ru
 * @property string $name_uz
 * @property string $name_en
 * @property int $icon_id
 * @property string $action
 * @property int $is_new
 * @property int $ignore_custom_order
 * @property int $ignore_disabled
 * @property string $platform
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class BankServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bank_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'icon_id', 'is_new', 'ignore_custom_order', 'ignore_disabled'], 'default', 'value' => null],
            [['sort', 'icon_id', 'is_new', 'ignore_custom_order', 'ignore_disabled'], 'integer'],
            [['name_ru', 'name_uz', 'name_en', 'icon_id', 'action'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['code'], 'string', 'max' => 250],
            [['name_ru', 'name_uz', 'name_en', 'action', 'platform'], 'string', 'max' => 255],
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
            'sort' => 'Sort',
            'name_ru' => 'Name Ru',
            'name_uz' => 'Name Uz',
            'name_en' => 'Name En',
            'icon_id' => 'Icon ID',
            'action' => 'Action',
            'is_new' => 'Is New',
            'ignore_custom_order' => 'Ignore Custom Order',
            'ignore_disabled' => 'Ignore Disabled',
            'platform' => 'Platform',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
