<?php

namespace common\models;

use common\helpers\DateTime;
use common\models\traits\Template;
use Yii;
use \common\models\base\Container_return as BaseContainer_return;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "container_return".
 */
class Container_return extends BaseContainer_return
{
    use Template;

    public function behaviors(): array
    {
        return DateTime::setLocalTimestamp(parent::behaviors());
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
