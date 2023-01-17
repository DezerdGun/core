<?php

namespace common\models;

use \common\models\base\Company as BaseCompany;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company".
 */
class Company extends BaseCompany
{

    public function behaviors(): array
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
                ['mc_number', 'unique', 'targetClass' => '\common\models\Company', 'message' => 'This MC number has already been taken.'],
                ['dot', 'unique', 'targetClass' => '\common\models\Company', 'message' => 'This DOT has already been taken.'],
                ['company_name', 'unique', 'targetClass' => '\common\models\Company', 'message' => 'This company name has already been taken.'],
            ]
        );
    }
}
