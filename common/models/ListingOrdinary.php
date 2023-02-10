<?php

namespace common\models;

use common\models\traits\Template;

use \common\models\base\ListingOrdinary as BaseListingOrdinary;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "listing_ordinary".
 */
class ListingOrdinary extends BaseListingOrdinary
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
                # custom validation rules
            ]
        );
    }

    public static function count(): array
    {
        return self::find()
            ->select(['status','COUNT(status) as number'])
            ->groupBy(['status'])
            ->asArray()
            ->all();
    }
}
