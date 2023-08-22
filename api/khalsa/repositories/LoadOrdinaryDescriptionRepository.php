<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;

class LoadOrdinaryDescriptionRepository implements RepositoryInterface
{

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function create($model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Saving error.');
        }
    }
}