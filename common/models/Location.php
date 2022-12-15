<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\Location as BaseLocation;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "location".
 */
class Location extends BaseLocation
{
    use Template;

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                TimestampBehavior::className(),
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
