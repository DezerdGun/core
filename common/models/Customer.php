<?php

namespace common\models;

use common\models\traits\Template;
use \common\models\base\Customer as BaseCustomer;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "customer".
 */
class Customer extends BaseCustomer
{
    use Template;

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
