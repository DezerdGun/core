<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "load_container_info".
 *
 * @property integer $id
 * @property integer $load_id
 * @property string $size
 * @property integer $owner
 * @property string $vessel_name
 * @property string $mbl
 * @property string $hbl
 * @property string $type
 * @property integer $container_number
 * @property integer $load_reference_number
 *
 * @property \common\models\Load $load
 * @property \common\models\Owner $owner0
 * @property \common\models\Container $type0
 * @property string $aliasModel
 */
abstract class LoadContainerInfo extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'load_container_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['load_id', 'owner', 'container_number', 'load_reference_number'], 'default', 'value' => null],
            [['load_id', 'owner', 'container_number', 'load_reference_number', 'size'], 'integer'],
            [['vessel_name', 'mbl', 'hbl', 'type'], 'string', 'max' => 32],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Container::className(), 'targetAttribute' => ['type' => 'code']],
            [['load_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Load::className(), 'targetAttribute' => ['load_id' => 'id']],
            [['owner'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Owner::className(), 'targetAttribute' => ['owner' => 'id']]
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
            'size' => 'Size',
            'owner' => 'Owner',
            'vessel_name' => 'Vessel Name',
            'mbl' => 'Mbl',
            'hbl' => 'Hbl',
            'type' => 'Type',
            'container_number' => 'Container Number',
            'load_reference_number' => 'Load Reference Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoad()
    {
        return $this->hasOne(\common\models\Load::className(), ['id' => 'load_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner0()
    {
        return $this->hasOne(\common\models\Owner::className(), ['id' => 'owner']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(\common\models\Container::className(), ['code' => 'type']);
    }




}
