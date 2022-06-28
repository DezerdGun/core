<?php

namespace common\models;

use Yii;
use \common\models\base\Load as BaseLoad;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load".
 */
class Load extends BaseLoad
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
