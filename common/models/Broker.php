<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\Broker as BaseBroker;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "broker".
 */
class Broker extends BaseBroker
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
