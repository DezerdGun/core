<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use common\models\Load;

class ContainerLoadRepository implements RepositoryInterface
{

    /**
     * @throws HttpException
     */
    public function getById($id): Load
    {
        if (!$model = Load::findOne(['id' => $id])) {
            throw new HttpException(404, 'Container Load is not found');
        }
        return $model;
    }

    /**
     * @throws HttpException
     */
    public function update(Load $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Updating error.');
        }
    }
}