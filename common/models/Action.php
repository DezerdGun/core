<?php

namespace common\models;

use Yii;
use \common\models\base\Action as BaseAction;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "action".
 */
class Action extends BaseAction
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
