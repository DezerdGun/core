<?php

namespace common\models;

use \common\models\base\Carrier as BaseCarrier;
use common\models\traits\Template;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "carrier".
 */
class Carrier extends BaseCarrier
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    use Template;

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            []
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            []
        );
    }
}
