<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\Carrier;

class CarrierRepository
{
    public function create(Carrier $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function update(Carrier $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function getByUserId($user_id): Carrier
    {
        if (!$model = Carrier::findOne(['user_id' => $user_id])) {
            throw new HttpException(404, 'Carrier is not found.');
        }
        return $model;
    }
}
