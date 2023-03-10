<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "ordinary_load".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $origin_id
 * @property integer $destination_id
 * @property string $pick_up_date
 * @property integer $user_id
 * @property string $status
 *  @property integer $load_reference_number
 *
 * @property \common\models\Company $customer
 * @property \common\models\Location $destination
 * @property \common\models\LoadOrdinaryAdditionalInfo $loadOrdinaryAdditionalInfos
 * @property \common\models\LoadOrdinaryDescription $loadOrdinaryDescriptions
 * @property \common\models\OrdinaryNeeded[] $ordinaryNeededs
 * @property \common\models\Location $origin
 * @property \common\models\User $user
 * @property string $aliasModel
 */
abstract class OrdinaryLoad extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordinary_load';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'origin_id', 'destination_id', 'user_id'], 'default', 'value' => null],
            [['customer_id', 'origin_id', 'destination_id', 'user_id'], 'integer'],
            [['pick_up_date'], 'safe'],
            [['user_id'], 'required'],
            [['status'], 'string', 'max' => 32],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Company::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['origin_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Location::className(), 'targetAttribute' => ['origin_id' => 'id']],
            [['destination_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Location::className(), 'targetAttribute' => ['destination_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\User::className(), 'targetAttribute' => ['user_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'origin_id' => 'Origin ID',
            'destination_id' => 'Destination ID',
            'pick_up_date' => 'Pick Up Date',
            'user_id' => 'User ID',
            'status' => 'Status',
            'load_reference_number' => 'Load Reference Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(\common\models\Company::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestination()
    {
        return $this->hasOne(\common\models\Location::className(), ['id' => 'destination_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoadOrdinaryAdditionalInfos()
    {
        return $this->hasOne(\common\models\LoadOrdinaryAdditionalInfo::className(), ['load_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoadOrdinaryDescriptions()
    {
        return $this->hasOne(\common\models\LoadOrdinaryDescription::className(), ['load_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdinaryNeededs()
    {
        return $this->hasMany(\common\models\OrdinaryNeeded::className(), ['equipment_needed_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigin()
    {
        return $this->hasOne(\common\models\Location::className(), ['id' => 'origin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }




}
