<?php

namespace common\models;

use common\models\traits\Template;
use \common\models\base\ContainerBid as BaseContainerBid;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "container_bid".
 */
class ContainerBid extends BaseContainerBid
{
    use Template;
    const SCENARIO_MAKE_FAVORITE = 'make_favorite';
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
                [['user_id'], 'unique', 'targetAttribute' => ['user_id', 'listing_container_id']]
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
}
