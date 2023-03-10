<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\ContainerBidLog as BaseContainerBidLog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "container_bid_log".
 */
class ContainerBidLog extends BaseContainerBidLog
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
