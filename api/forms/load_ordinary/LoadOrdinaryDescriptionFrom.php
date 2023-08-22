<?php

namespace api\forms\listing\ordinary;


use yii\base\Model;

class LoadOrdinaryDescriptionFrom extends Model
{
    public $load_ordinary_description_id;
    public $commodity;
    public $description;
    public $pieces;
    public $pallets;
    public $weight_KGs;
    public $weight_LBs;


    public function rules(): array
    {
       return [
            [['pieces', 'pallets'], 'integer'],
            [['commodity', 'description','weight_KGs','weight_LBs'], 'string'],
//           [['equipment_code'], 'each', 'rule' => ['exist', 'targetClass' => Equipment::className(), 'targetAttribute' => ['equipment_code' => 'code']]],
       ];
    }
}
