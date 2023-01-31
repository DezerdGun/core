<?php

namespace common\models;

use Yii;
use \common\models\base\Date as BaseDate;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "date".
 */
class Date extends BaseDate
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
