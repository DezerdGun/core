<?php

namespace api\forms\listing\ordinary;

use common\models\Equipment;
use yii\base\Model;

class ListingOrdinaryForm extends Model
{
    public $origin_id;
    public $destination_id;
    public $equipment_code;
    public $pick_up;

    public function rules()
    {
       return [
            [['origin_id', 'destination_id', 'equipment_code', 'pick_up'], 'required'],
            [['origin_id', 'destination_id'], 'integer'],
            ['pick_up', 'date', 'format' => 'php:Y-m-d'],
            [['equipment_code'], 'each', 'rule' => ['string']],
            [['equipment_code'], 'each', 'rule' => ['exist', 'targetClass' => Equipment::className(), 'targetAttribute' => ['equipment_code' => 'code']]],
       ];
    }
}
