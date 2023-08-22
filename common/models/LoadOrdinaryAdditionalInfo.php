<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\LoadOrdinaryAdditionalInfo as BaseLoadOrdinaryAdditionalInfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_ordinary_additional_info".
 */
class LoadOrdinaryAdditionalInfo extends BaseLoadOrdinaryAdditionalInfo
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
                ['overweight_description', 'required', 'when' => function($model) {
                    return $model->overweight == 'yes';
                }],

                ['reefer_description', 'required', 'when' => function($model) {
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