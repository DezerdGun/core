<?php

namespace api\khalsa\repositories;

use api\khalsa\interfaces\RepositoryInterface;
use api\khalsa\NotFoundException;
use common\models\Holds;

class holdsLoadContainerInfoRepository implements RepositoryInterface
{

    public function getById($id): Holds
    {

        if (!$model = Holds::findOne(['id' => $id])) {
            throw new NotFoundException('Hold is not found.');
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