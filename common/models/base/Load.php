<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "load".
 *
 * @property integer $id
 * @property string $vessel_eta
 * @property integer $customer_id
 * @property integer $port_id
 * @property integer $consignee_id
 * @property integer $user_id
 * @property string $status
 *
 * @property \common\models\Location $consignee
 * @property \common\models\Customer $customer
 * @property \common\models\LoadAdditionalInfo[] $loadAdditionalInfos
 * @property \common\models\LoadBid[] $loadBs
 * @property \common\models\LoadContainerInfo[] $loadContainerInfos
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
            [['vessel_eta'], 'safe'],
            [['customer_id', 'port_id', 'consignee_id', 'user_id'], 'default', 'value' => null],
            [['customer_id', 'port_id', 'consignee_id', 'user_id'], 'integer'],
            [['status'], 'string', 'max' => 32],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['port_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Location::className(), 'targetAttribute' => ['port_id' => 'id']],
            [['consignee_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Location::className(), 'targetAttribute' => ['consignee_id' => 'id']],
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
            'vessel_eta' => 'Vessel Eta',
            'customer_id' => 'Customer ID',
            'port_id' => 'Port ID',
            'consignee_id' => 'Consignee ID',
            'user_id' => 'User ID',
            'status' => 'Status',
        ];
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
    public function getCustomer()
    {
        return $this->hasOne(\common\models\Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoadAdditionalInfos()
    {
        return $this->hasMany(\common\models\LoadAdditionalInfo::className(), ['load_id' => 'id']);
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
        return $this->hasMany(\common\models\LoadContainerInfo::className(), ['load_id' => 'id']);
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
