<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "load_ordinary_description_rows".
 *
 * @property integer $id
 * @property integer $load_ordinary_description_id
 * @property string $commodity
 * @property string $description
 * @property integer $pieces
 * @property string $pallets
 * @property string $weight_KGs
 * @property string $weight_LBs
 *
 * @property \common\models\LoadOrdinaryDescription $loadOrdinaryDescription
 * @property string $aliasModel
 */
abstract class LoadOrdinaryDescriptionRows extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'load_ordinary_description_rows';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['load_ordinary_description_id', 'pieces'], 'default', 'value' => null],
            [['load_ordinary_description_id', 'pieces'], 'integer'],
            [['weight_KGs', 'weight_LBs'], 'number'],
            [['commodity', 'description', 'pallets'], 'string', 'max' => 32],
            [['load_ordinary_description_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\LoadOrdinaryDescription::className(), 'targetAttribute' => ['load_ordinary_description_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'load_ordinary_description_id' => 'Load Ordinary Description ID',
            'commodity' => 'Commodity',
            'description' => 'Description',
            'pieces' => 'Pieces',
            'pallets' => 'Pallets',
            'weight_KGs' => 'Weight K Gs',
            'weight_LBs' => 'Weight L Bs',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoadOrdinaryDescription()
    {
        return $this->hasOne(\common\models\LoadOrdinaryDescription::className(), ['id' => 'load_ordinary_description_id']);
    }




}