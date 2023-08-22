<?php

namespace api\forms\customer;

use yii\base\Model;

class CustomerDeleteForm extends Model
{
    public $id;

    public function rules(): array
    {
        return [
            ['id', 'integer'],
            ['id', 'exist', 'targetClass' => '\common\models\Customer', 'message' => 'Customer ID not found.'],
        ];
    }
}
