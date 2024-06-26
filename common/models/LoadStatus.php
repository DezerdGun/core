<?php

namespace common\models;

use Yii;
use \common\models\base\LoadStatus as BaseLoadStatus;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_status".
 */
class LoadStatus extends BaseLoadStatus
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
