<?php

namespace common\models;

use Yii;
use \common\models\base\TruckTypes as BaseTruckTypes;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "truck_types".
 */
class TruckTypes extends BaseTruckTypes
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
