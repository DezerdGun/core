<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "load".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $port_id
 * @property integer $consignee_id
 * @property integer $user_id
 * @property string $status
 * @property string $pick_up_from
 * @property string $pick_up_to
 * @property string $delivery_from
 * @property string $delivery_to
 * @property integer $load_reference_number
 * @property string $vessel_eta
 * @property integer $billing_id
 * @property integer $carrier_id
 *
 * @property \common\models\Carrier $carrier
 * @property \common\models\Chassis_locations[] $chassisLocations
 * @property \common\models\Location $consignee
 * @property \common\models\Container_return[] $containerReturns
 * @property \common\models\Customer $customer
 * @property \common\models\Date $dates
 * @property \common\models\Holds[] $holds
 * @property \common\models\Holds_history[] $holdsHistories
 * @property \common\models\LoadAdditionalInfo $loadAdditionalInfos
 * @property \common\models\LoadBid[] $loadBs
 * @property \common\models\LoadContainerInfo $loadContainerInfos
 * @property \common\models\LoadDocuments[] $loadDocuments
 * @property \common\models\LoadStop[] $loadStops
 * @property \common\models\LoadStop[] $loadStops0
 * @property \common\models\LoadTracking[] $loadTrackings
 * @property \common\models\Location $port
 * @property \common\models\User $user
 * @property string $aliasModel
 */
abstract class Load extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'load';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'port_id', 'consignee_id', 'user_id', 'load_reference_number', 'billing_id', 'carrier_id'], 'default', 'value' => null],
            [['customer_id', 'port_id', 'consignee_id', 'user_id', 'load_reference_number', 'billing_id', 'carrier_id'], 'integer'],
            [['pick_up_from', 'pick_up_to', 'delivery_from', 'delivery_to', 'vessel_eta'], 'safe'],
            [['status'], 'string', 'max' => 32],
            [['carrier_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Carrier::className(), 'targetAttribute' => ['carrier_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['port_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Location::className(), 'targetAttribute' => ['port_id' => 'id']],
            [['consignee_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Location::className(), 'targetAttribute' => ['consignee_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['billing_id', 'exist', 'targetClass' => \common\models\Billing::className(), 'targetAttribute' => ['billing_id' => 'id']]
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
            'port_id' => 'Port ID',
            'consignee_id' => 'Consignee ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'pick_up_from' => 'Pick Up From',
            'pick_up_to' => 'Pick Up To',
            'delivery_from' => 'Delivery From',
            'delivery_to' => 'Delivery To',
            'load_reference_number' => 'Load Reference Number',
            'vessel_eta' => 'Vessel Eta',
            'billing_id' => 'Billing ID',
            'carrier_id' => 'Carrier ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarrier()
    {
        return $this->hasOne(\common\models\Carrier::className(), ['id' => 'carrier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChassisLocations()
    {
        return $this->hasMany(\common\models\ChassisLocations::className(), ['load_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsignee()
    {
        return $this->hasOne(\common\models\Location::className(), ['id' => 'consignee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContainerReturns()
    {
        return $this->hasMany(\common\models\ContainerReturn::className(), ['load_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(\common\models\Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDates()
    {
        return $this->hasMany(\common\models\Date::className(), ['load_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHolds()
    {
        return $this->hasMany(\common\models\Holds::className(), ['load_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHoldsHistories()
    {
        return $this->hasMany(\common\models\HoldsHistory::className(), ['load_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoadAdditionalInfos()
    {
        return $this->hasOne(\common\models\LoadAdditionalInfo::className(), ['load_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoadBs()
    {
        return $this->hasMany(\common\models\LoadBid::className(), ['load_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoadContainerInfos()
    {
        return $this->hasOne(\common\models\LoadContainerInfo::className(), ['load_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoadDocuments()
    {
        return $this->hasMany(\common\models\LoadDocuments::className(), ['load_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoadStops()
    {
        return $this->hasMany(\common\models\LoadStop::className(), ['port_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoadStops0()
    {
        return $this->hasMany(\common\models\LoadStop::className(), ['company_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoadTrackings()
    {
        return $this->hasMany(\common\models\LoadTracking::className(), ['load_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPort()
    {
        return $this->hasOne(\common\models\Location::className(), ['id' => 'port_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }




}
