<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\Load as BaseLoad;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load".
 */
class Load extends BaseLoad
{
    use Template;

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [

            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                [['load_type', 'route_type', 'order'], 'string'],
                [['customer_id', 'port_id', 'consignee_id'], 'integer'],
            ]
        );
    }

}
