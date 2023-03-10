<?php

namespace common\models;

use common\models\traits\Template;
use \common\models\base\OrdinaryLoad as BaseOrdinaryLoad;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ordinary_load".
 */
class   OrdinaryLoad extends BaseOrdinaryLoad
{
    use Template;
    public function behaviors(): array
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules(): array
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}
