<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "location".
 *
 * @property integer $id
 * @property string $name
 * @property integer $address_id
 * @property integer $contact_info_id
 * @property string $location_type
 * @property \common\models\Address $address
 * @property \common\models\ContactInfo $contactInfo
 * @property string $aliasModel
 */
abstract class Location extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_id', 'name', 'location_type'], 'required'],
            [['contact_info_id'], 'required', 'on' => 'update'],
            [['address_id'], 'default', 'value' => null],
            [['address_id'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['name'], 'unique'],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Address::className(), 'targetAttribute' => ['address_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address_id' => 'Address ID',
            'location_type' => 'Location type',
            'contact_info_id' => 'Contact Info ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(\common\models\Address::className(), ['id' => 'address_id']);
    }

    public function getContactInfo()
    {
        return $this->hasOne(\common\models\ContactInfo::className(), ['id' => 'contact_info_id']);
    }

}
