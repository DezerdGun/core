<?php

namespace common\models;

use Yii;
use \common\models\base\load_modes as Baseload_modes;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_modes".
 */
class load_modes extends Baseload_modes
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
