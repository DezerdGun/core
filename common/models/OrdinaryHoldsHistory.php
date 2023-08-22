<?php

namespace common\models;

use common\helpers\DateTime;
use Yii;
use \common\models\base\OrdinaryHoldsHistory as BaseOrdinaryHoldsHistory;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ordinary_holds_history".
 */
class OrdinaryHoldsHistory extends BaseOrdinaryHoldsHistory
{

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
