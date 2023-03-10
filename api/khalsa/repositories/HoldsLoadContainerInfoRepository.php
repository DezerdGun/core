<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use api\khalsa\NotFoundException;
use common\models\Holds;

class holdsLoadContainerInfoRepository implements RepositoryInterface
{

    public function getById($load_id): Holds
    {

        if (!$model = Holds::findOne(['load_id' => $load_id])) {
            throw new HttpException(400, 'Holds Load_Id is not found.');
        }
        return $model;
    }

    public function create(Holds $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function update(Holds $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Updating error.');
        }
    }
}