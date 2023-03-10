<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\Chassis_locations as BaseChassis_locations;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "chassis_locations".
 */
class Chassis_locations extends BaseChassis_locations
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
                [['chassis_pickup','chassis_termination'], 'integer'],
            ]
        );
    }
}
