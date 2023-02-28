<?php

namespace common\models;

use Yii;
use \common\models\base\LoadOrdinaryDescriptionRows as BaseLoadOrdinaryDescriptionRows;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_ordinary_description_rows".
 */
class LoadOrdinaryDescriptionRows extends BaseLoadOrdinaryDescriptionRows
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
