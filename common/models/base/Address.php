<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "address".
 *
 * @property integer $id
 * @property string $street_address
 * @property string $city
 * @property string $state_code
 * @property string $zip
 * @property string $lat
 * @property string $long
 *
 * @property \common\models\Company[] $companies
 * @property \common\models\Location[] $locations
 * @property \common\models\State $stateCode
 * @property string $aliasModel
 */
abstract class Address extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['street_address', 'city', 'state_code', 'zip', 'lat', 'long'], 'string', 'max' => 32],
            [['state_code'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\State::className(), 'targetAttribute' => ['state_code' => 'state_code']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'street_address' => 'Street Address',
            'city' => 'City',
            'state_code' => 'State Code',
            'zip' => 'Zip',
            'lat' => 'Lat',
            'long' => 'Long',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasMany(\common\models\Company::className(), ['address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(\common\models\Location::className(), ['address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(\common\models\State::className(), ['state_code' => 'state_code']);
    }




}
