<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "load_reference_number".
 *
 * @property integer $id
 * @property integer $load_id
 * @property string $mbl
 * @property string $hbl
 * @property string $seal
 * @property string $vessel_name
 * @property string $voyage
 * @property string $purchase_order
 * @property string $shipment
 * @property string $pick_up
 * @property string $appointment
 * @property string $return
 * @property string $reservation
 *
 * @property \common\models\LoadContainerInfo $load
 * @property string $aliasModel
 */
abstract class LoadReferenceNumber extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'load_reference_number';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['load_id'], 'default', 'value' => null],
            [['load_id'], 'integer'],
            [['mbl', 'hbl', 'seal', 'vessel_name', 'voyage', 'purchase_order', 'shipment', 'pick_up', 'appointment', 'return', 'reservation'], 'string', 'max' => 32],
            [['load_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\LoadContainerInfo::className(), 'targetAttribute' => ['load_id' => 'id']],
            ['load_id', 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'load_id' => 'Load ID',
            'mbl' => 'Mbl',
            'hbl' => 'Hbl',
            'seal' => 'Seal',
            'vessel_name' => 'Vessel Name',
            'voyage' => 'Voyage',
            'purchase_order' => 'Purchase Order',
            'shipment' => 'Shipment',
            'pick_up' => 'Pick Up',
            'appointment' => 'Appointment',
            'return' => 'Return',
            'reservation' => 'Reservation',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoad()
    {
        return $this->hasOne(\common\models\LoadContainerInfo::className(), ['id' => 'load_id']);
    }




}
