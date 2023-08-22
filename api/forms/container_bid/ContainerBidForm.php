<?php

namespace api\forms\container_bid;

use common\models\ContainerBid;
use yii\base\Model;

class ContainerBidForm extends Model
{
    public $is_favorite;
    public function rules()
    {
        return [
            ['is_favorite' , 'required'],
            [['is_favorite'],  'boolean', 'trueValue' => "true", 'falseValue' => "false", 'strict' => false],
        ];
    }
}