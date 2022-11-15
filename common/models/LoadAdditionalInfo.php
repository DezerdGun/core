<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\LoadAdditionalInfo as BaseLoadAdditionalInfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_additional_info".
 */
class LoadAdditionalInfo extends BaseLoadAdditionalInfo
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
                ['hazmat_description', 'required', 'when' => function($model) {
                    return $model->hazmat == 'yes';
                }],
                ['weight_in_lbs', 'required', 'when' => function($model) {
                    return $model->overweight == 'yes';
                }],
                ['temp_in_f', 'required', 'when' => function($model) {
                    return $model->reefer == 'yes';
                }],
                ['alcohol_description', 'required', 'when' => function($model) {
                    return $model->alcohol == 'yes';
                }],
                ['urgent_description', 'required', 'when' => function($model) {
                    return $model->urgent == 'yes';
                }],
            ]
        );
    }
}
