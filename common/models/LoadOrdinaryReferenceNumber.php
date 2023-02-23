<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\LoadOrdinaryReferenceNumber as BaseLoadOrdinaryReferenceNumber;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_ordinary_reference_number".
 */
class LoadOrdinaryReferenceNumber extends BaseLoadOrdinaryReferenceNumber
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
