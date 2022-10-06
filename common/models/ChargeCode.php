<?php

namespace common\models;

use Yii;
use \common\models\base\ChargeCode as BaseChargeCode;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "charge_code".
 */
class ChargeCode extends BaseChargeCode
{

    public function behaviors()
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
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}
