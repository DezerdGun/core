<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\Carrier;
use yii\db\StaleObjectException;

class CarrierRepository
{
    public function create(Carrier $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Saving error.');
        }
    }

    /**
     * @throws StaleObjectException
     * @throws HttpException
     */
    public function update(Carrier $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Saving error.');
        }
    }

    /**
     * @throws HttpException
     */
    public function getByUserId($user_id): Carrier
    {
        if (!$model = Carrier::findOne(['user_id' => $user_id])) {
            throw new HttpException(404, 'Carrier is not found.');
        }
        return $model;
    }
}
