<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "link_provider".
 *
 * @property int $id
 * @property string $type
 * @property string $url
 * @property string|null $status Status
 * @property int $created_at
 */
class LinkProvider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'link_provider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'url', 'created_at'], 'required'],
            [['created_at'], 'default', 'value' => null],
            [['created_at'], 'integer'],
            [['type'], 'string', 'max' => 20],
            [['url'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'url' => 'Url',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
