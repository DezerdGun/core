<?php

namespace common\models;

use \common\models\base\BillingDetail as BaseBillingDetail;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "billing_detail".
 */
class BillingDetail extends BaseBillingDetail
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
