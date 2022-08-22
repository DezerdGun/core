<?php

namespace common\models;

use Yii;
use \common\models\base\Address as BaseAddress;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "address".
 */

class Address extends BaseAddress
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

                [['street_address', 'zip','city','country'],'required'],
                // the name, subject and body attributes are required
                ['state_code', 'safe'],
            ]
        );
    }
}
