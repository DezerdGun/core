<?php

namespace common\models;

use Yii;
use \common\models\base\Carrier as BaseCarrier;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "carrier".
 */
class Carrier extends BaseCarrier
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

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
