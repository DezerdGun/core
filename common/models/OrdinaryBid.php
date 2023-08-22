<?php

namespace common\models;

use common\models\traits\Template;
use \common\models\base\OrdinaryBid as BaseOrdinaryBid;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ordinary_bid".
 */
class OrdinaryBid extends BaseOrdinaryBid
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
                ['is_favorite', 'boolean', 'trueValue' => true, 'falseValue' => false, 'strict' => false],
                ['is_favorite', 'changeType'],
                [['user_id'], 'unique', 'targetAttribute' => ['user_id', 'listing_ordinary_id']]
            ]
        );
    }

    public function changeType()
    {
        if ($this->is_favorite == 'true') {
            $this->is_favorite = true;
        } else if ($this->is_favorite == 'false') {
            $this->is_favorite = false;
        }
    }

    public static function countBids(): array
    {
        return self::find()
            ->select(['is_favorite','COUNT(is_favorite) as number'])
            ->groupBy(['is_favorite'])
            ->where(['user_id' => \Yii::$app->user->id])
            ->asArray()
            ->all();
    }
}
