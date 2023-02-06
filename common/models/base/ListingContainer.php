<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "listing_container".
 *
 * @property integer $id
 * @property string $status
 * @property integer $port_id
 * @property integer $destination_id
 * @property string $vessel_eta
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\Location $destination
 * @property \common\models\ListingContainerAdditionalInfo $additionalInfo
 * @property \common\models\ListingContainerInfo $containerInfo
 * @property \common\models\Location $port
 * @property User $user
 * @property string $aliasModel
 */
abstract class ListingContainer extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'listing_container';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['port_id', 'destination_id', 'user_id'], 'default', 'value' => null],
            [['port_id', 'destination_id', 'user_id'], 'integer'],
            ['vessel_eta', 'safe'],
            ['vessel_eta', 'date', 'format' => 'php:Y-m-d'],
            [['status'], 'string', 'max' => 255],
            [['port_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Location::className(), 'targetAttribute' => ['port_id' => 'id']],
            [['destination_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Location::className(), 'targetAttribute' => ['destination_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'port_id' => 'Port ID',
            'destination_id' => 'Destination ID',
            'vessel_eta' => 'Vessel Eta',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public function getAdditionalInfo()
    {
        return $this->hasOne(\common\models\ListingContainerAdditionalInfo::className(), ['listing_container_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContainerInfo()
    {
        return $this->hasOne(\common\models\ListingContainerInfo::className(), ['listing_container_id' => 'id']);
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
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }




}
