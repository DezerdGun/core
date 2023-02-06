<?php

namespace api\forms\listing;

use common\enums\ListingStatus;
use common\models\ListingContainer;
use yii\base\Model;

class ListingContainerForm extends Model
{
    public $id;
    public $status;

    public function rules()
    {
        return [
            [['id', 'status'], 'required'],
            [['id'], 'each', 'rule' => ['string']],
            [['id'], 'each', 'rule' => ['exist', 'targetClass' => ListingContainer::className(), 'targetAttribute' => ['id' => 'id']]],
            ['status', 'in', 'range' => ListingStatus::getEnums()]
        ];
    }

}
