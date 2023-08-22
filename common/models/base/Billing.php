<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "billing".
 *
 * @property integer $id
 * @property string $note
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\BillingDetail[] $billingDetails
 * @property \common\models\Load $load
 * @property string $aliasModel
 */
abstract class Billing extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'billing';
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
            [['note'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'note' => 'Note',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillingDetails()
    {
        return $this->hasMany(\common\models\BillingDetail::className(), ['billing_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoad()
    {
        return $this->hasOne(\common\models\Load::className(), ['billing_id' => 'id']);
    }




}
