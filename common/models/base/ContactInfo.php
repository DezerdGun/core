<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "contact_info".
 *
 * @property integer $id
 * @property string $main_phone_number
 * @property string $additional_phone_number
 * @property string $main_email
 * @property string $additional_email
 *
 * @property \common\models\Location[] $locations
 * @property string $aliasModel
 */
abstract class ContactInfo extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['main_phone_number', 'additional_phone_number', 'main_email', 'additional_email'], 'string', 'max' => 32],
            [['main_email', 'additional_email'], 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_phone_number' => 'Main Phone Number',
            'additional_phone_number' => 'Additional Phone Number',
            'main_email' => 'Main Email',
            'additional_email' => 'Additional Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(\common\models\Location::className(), ['contact_info_id' => 'id']);
    }




}