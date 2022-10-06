<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\LoadBid as BaseLoadBid;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_bid".
 */
class LoadBid extends BaseLoadBid
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
