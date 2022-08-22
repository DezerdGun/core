<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\LoadTracking as BaseLoadTracking;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_tracking".
 */
class LoadTracking extends BaseLoadTracking
{
    use Template;

    const SCENARIO_INSERT = 'insert';

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
