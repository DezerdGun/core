<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "date".
 *
 * @property integer $id
 * @property string $vessel_eta
 * @property string $last_free_day
 * @property string $discharged_date
 * @property string $outgate_date
 * @property string $empty_date
 * @property string $ingate_ate
 *
 * @property \common\models\Load[] $loads
 * @property string $aliasModel
 */
abstract class Date extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'date';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vessel_eta', 'last_free_day', 'discharged_date', 'outgate_date', 'empty_date', 'ingate_ate'], 'safe']
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
            'last_free_day' => 'Last Free Day',
            'discharged_date' => 'Discharged Date',
            'outgate_date' => 'Outgate Date',
            'empty_date' => 'Empty Date',
            'ingate_ate' => 'Ingate Ate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoads()
    {
        return $this->hasMany(\common\models\Load::className(), ['vessel_eta' => 'id']);
    }




}