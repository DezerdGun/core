<?php

namespace common\models;

use Yii;
use \common\models\base\Measure as BaseMeasure;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "measure".
 */
class Measure extends BaseMeasure
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
