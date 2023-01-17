<?php

namespace common\models;

use \common\models\base\ContactInfo as BaseContactInfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "contact_info".
 */
class ContactInfo extends BaseContactInfo
{
    const SCENARIO_CUSTOMER = 'customer';

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
                [['main_email', 'main_phone_number'], 'required', 'on' => self::SCENARIO_CUSTOMER]
            ]
        );
    }
}
