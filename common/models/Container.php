<?php

namespace common\models;

use Yii;
use \common\models\base\Container as BaseContainer;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "container".
 */
class Container extends BaseContainer
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
