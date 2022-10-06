<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "load_tracking".
 *
 * @property integer $id
 * @property integer $load_id
 * @property string $created
 * @property double $lat
 * @property double $long
 *
 * @property \common\models\Load $load
 * @property string $aliasModel
 */
abstract class Load_tracking extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'load_tracking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['load_id'], 'default', 'value' => null],
            [['load_id'], 'integer'],
            [['created'], 'safe'],
            [['lat', 'long'], 'number'],
            [['load_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Load::className(), 'targetAttribute' => ['load_id' => 'id']]
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
            'created' => 'Created',
            'lat' => 'Lat',
            'long' => 'Long',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoad()
    {
        return $this->hasOne(\common\models\Load::className(), ['id' => 'load_id']);
    }




}