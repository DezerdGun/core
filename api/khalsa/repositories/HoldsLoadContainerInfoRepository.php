<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use api\khalsa\NotFoundException;
use common\models\Holds;

class holdsLoadContainerInfoRepository implements RepositoryInterface
{

    public function getById($id): Holds
    {

        if (!$model = Holds::findOne(['load_id' => $id])) {
            throw new HttpException(400, 'Holds Load_Id is not found.');
        }
        return $model;
    }

    /**
     * @throws HttpException
     */
    public function create(Holds $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Saving error.');
        }
    }

    public function update(Holds $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Updating error.');
        }
    }
}