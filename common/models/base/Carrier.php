<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "carrier".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $mc
 * @property string $dot
 * @property string $ein
 * @property string $w9_file
 * @property string $w9_mime_type
 * @property string $ic_file
 * @property string $ic_mime_type
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $aliasModel
 */
abstract class Carrier extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carrier';
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
            ['user_id', 'integer'],
            [['mc', 'dot', 'ein'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => "User ID",
            'mc' => 'Mc',
            'dot' => 'Dot',
            'ein' => 'Ein',
            'w9_file' => 'W 9',
            'ic_file' => 'Ic',
            'w9_mime_type' => 'w9 mime type',
            'ic_mime_type' => 'ic mime type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }



    /**
     * @inheritdoc
     * @return \api\models\CarrierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \api\models\CarrierQuery(get_called_class());
    }


}
