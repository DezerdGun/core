<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "ordinary_needed".
 *
 * @property integer $id
 * @property string $ordinary_need
 *
 * @property \common\models\OrdinaryLoad[] $ordinaryLoads
 * @property string $aliasModel
 */
abstract class OrdinaryNeeded extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordinary_needed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ordinary_need'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ordinary_need' => 'Ordinary Need',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdinaryLoads()
    {
        return $this->hasMany(\common\models\OrdinaryLoad::className(), ['equipment_need' => 'id']);
    }




}