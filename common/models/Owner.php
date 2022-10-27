<?php

namespace common\models;

use Yii;
use \common\models\base\Owner as BaseOwner;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "owner".
 */
class Owner extends BaseOwner
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
