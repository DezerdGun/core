<?php

namespace common\models;

use \common\models\base\Company as BaseCompany;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company".
 */
class Company extends BaseCompany
{
    const SCENARIO_CARRIER_CREATE = 'carrier_create';
    public $is_dot;

    public function behaviors(): array
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(), [
            ['company_name', 'required'],
            [['is_dot'], 'required', 'on' => self::SCENARIO_CARRIER_CREATE],
            ['mc_number', 'required', 'when' => function ($model) {
                return $model->is_dot === "false";
            }, 'on' => self::SCENARIO_CARRIER_CREATE],
            ['dot', 'required', 'when' => function ($model) {
                return $model->is_dot === "true";
            }, 'on' => self::SCENARIO_CARRIER_CREATE],
            [['mc_number', 'dot', 'ein'], 'default', 'value' => null],
            [['mc_number', 'dot', 'is_dot'], 'string'],
        ]);
    }
}
