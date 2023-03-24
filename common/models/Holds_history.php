<?php

namespace common\models;

use common\helpers\DateTime;
use common\models\traits\Template;
use Yii;
use \common\models\base\Holds_history as BaseHolds_history;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "holds_history".
 */
class Holds_history extends BaseHolds_history
{
    use Template;
    public function behaviors()
    {
        return DateTime::setLocalTimestamp(parent::behaviors());
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
