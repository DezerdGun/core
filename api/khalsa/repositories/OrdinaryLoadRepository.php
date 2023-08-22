<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use common\models\OrdinaryLoad;

class OrdinaryLoadRepository implements RepositoryInterface
{

    /**
     * @throws HttpException
     */
    public function getById($id): OrdinaryLoad
    {
       if (!$model = OrdinaryLoad::findOne(['id' => $id])) {
           throw new HttpException(404, 'Ordinary Load is not found.');
       }
       return $model;
    }

    public function update(OrdinaryLoad $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Updating error');
        }
    }
}