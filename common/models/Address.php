<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\Address as BaseAddress;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "address".
 */

class Address extends BaseAddress
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
                [['street_address', 'zip','city', 'state_code'],'required'],
                // the name, subject and body attributes are required
                ['state_code', 'safe'],
                ['state_code', 'exist', 'targetClass' => '\common\models\State', 'targetAttribute' => ['state_code' => 'state_code'], 'message' => 'State code not found.'],
            ]
        );
    }
}
