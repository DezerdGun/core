<?php

namespace common\models;

use Yii;
use \common\models\base\OrdinaryEquipment as BaseOrdinaryEquipment;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ordinary_equipment".
 */
class OrdinaryEquipment extends BaseOrdinaryEquipment
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
