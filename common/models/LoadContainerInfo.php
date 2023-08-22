<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\LoadContainerInfo as BaseLoadContainerInfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_container_info".
 */
class LoadContainerInfo extends BaseLoadContainerInfo
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
