<?php

namespace api\khalsa\repositories;

use common\models\Broker;
use api\khalsa\NotFoundException;

class BrokerRepository implements \api\khalsa\interfaces\RepositoryInterface
{

    public function getById($id): Broker
    {
        if (!$model = Broker::findOne(['id' => $id])) {
            throw new NotFoundException('Broker is not found.');
        }
        return $model;
    }

    public function getByUserId($user_id): Broker
    {
        if (!$model = Broker::findOne(['user_id' => $user_id])) {
            throw new NotFoundException('Broker is not found.');
        }
        return $model;
    }

    public function create(Broker $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}
