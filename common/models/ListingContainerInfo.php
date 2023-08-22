<?php

namespace common\models;

use common\models\traits\Template;
use \common\models\base\ListingContainerInfo as BaseListingContainerInfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "listing_container_info".
 */
class ListingContainerInfo extends BaseListingContainerInfo
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
}
