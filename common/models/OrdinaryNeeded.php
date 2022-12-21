<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\OrdinaryNeeded as BaseOrdinaryNeeded;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ordinary_needed".
 */
class OrdinaryNeeded extends BaseOrdinaryNeeded
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
