<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\StripeCustomer as BaseStripeCustomer;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "stripe_customer".
 */
class StripeCustomer extends BaseStripeCustomer
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
                [['user_id', 'cus_id'], 'required'],
                ['cus_id', 'string'],
                ['user_id', 'integer'],
                ['user_id', 'unique', 'targetClass' => '\common\models\StripeCustomer', 'message' => 'Stripe customer with this user id already exists.'],
            ]
        );
    }

    public static function findByUserID($user_id)
    {
        return static::findOne([
            'user_id' => $user_id,
        ]);
    }
}
