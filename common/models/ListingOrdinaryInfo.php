<?php

namespace common\models;

use Yii;
use \common\models\base\ListingOrdinaryInfo as BaseListingOrdinaryInfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "listing_ordinary_description".
 */
class ListingOrdinaryInfo extends BaseListingOrdinaryInfo
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
