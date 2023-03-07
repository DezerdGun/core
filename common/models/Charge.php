<?php

namespace common\models;

use Yii;
use \common\models\base\Charge as BaseCharge;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "charge".
 */
class Charge extends BaseCharge
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
