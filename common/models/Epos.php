<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "epos".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $specification
 * @property int|null $sort
 * @property string|null $merchant
 * @property string|null $terminal
 * @property string|null $port
 * @property int|null $processing
 * @property int|null $auto_reco
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Epos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'processing', 'auto_reco'], 'default', 'value' => null],
            [['sort', 'processing', 'auto_reco'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code', 'specification'], 'string', 'max' => 250],
            [['merchant', 'terminal', 'port'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'specification' => 'Specification',
            'sort' => 'Sort',
            'merchant' => 'Merchant',
            'terminal' => 'Terminal',
            'port' => 'Port',
            'processing' => 'Processing',
            'auto_reco' => 'Auto Reco',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
