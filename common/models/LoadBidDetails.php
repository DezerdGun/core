<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\LoadBidDetails as BaseLoadBidDetails;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_bid_details".
 */
class LoadBidDetails extends BaseLoadBidDetails
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
                array('load_bid_id','unique','message'=>'{attribute}:{value} already exists!'),
            ]
        );
    }
}
