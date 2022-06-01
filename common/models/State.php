<?php

namespace common\models;

use Yii;
use \common\models\base\State as BaseListstate;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "liststate".
 * @method search(array|mixed $queryParams)
 */
class State extends BaseListstate
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
