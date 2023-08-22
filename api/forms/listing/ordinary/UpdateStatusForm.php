<?php

namespace api\forms\listing\ordinary;

use common\enums\ListingStatus;
use common\models\ListingOrdinary;

class UpdateStatusForm extends \yii\base\Model
{
    public $id;
    public $status;

    public function rules()
    {
        return [
            [['id', 'status'], 'required'],
            [['id'], 'each', 'rule' => ['integer']],
            [['id'], 'each', 'rule' => ['exist', 'targetClass' => ListingOrdinary::className(), 'targetAttribute' => ['id' => 'id']]],
            ['status', 'in', 'range' => ListingStatus::getEnums()]
        ];
    }
}
