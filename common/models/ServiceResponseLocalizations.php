<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_response_localizations".
 *
 * @property int $ID
 * @property string $CODE
 * @property string|null $DESCRIPTION
 * @property string|null $TYPE
 * @property string|null $KEY
 * @property string|null $CREATED_AT
 * @property string|null $UPDATED_AT
 */
class ServiceResponseLocalizations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_response_localizations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CODE'], 'required'],
            [['CREATED_AT', 'UPDATED_AT'], 'safe'],
            [['CODE', 'DESCRIPTION', 'TYPE', 'KEY'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'CODE' => 'Code',
            'DESCRIPTION' => 'Description',
            'TYPE' => 'Type',
            'KEY' => 'Key',
            'CREATED_AT' => 'Created At',
            'UPDATED_AT' => 'Updated At',
        ];
    }
}
