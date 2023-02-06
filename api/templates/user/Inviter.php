<?php

namespace api\templates\user;

use common\models\Broker;
use common\models\User;
use TRS\RestResponse\templates\BaseTemplate;

class Inviter extends BaseTemplate
{
        protected function prepareResult()
    {
        /** @var User $model */
        $model = $this->model;
        $int = Broker::findOne(['user_id' => $model->id]);
        $this->result = [
            'id' => $model->id,
                'name' => $model->name,
                'email' => $model->email,
                'mobile_number' => $model->mobile_number,
                'role' => $model->role,
                'inviter' =>  User::find()
                    ->select('id,name,email,role')
                    ->where(['id' => $int->master_id])
                    ->one(),
        ];
    }
}