<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use common\models\OrdinaryLoad;
use yii\db\StaleObjectException;

class LoadOrdinaryRepository implements RepositoryInterface
{

    public function getById($id)
    {
        if (!$model = OrdinaryLoad::findOne(['id' => $id])) {
            throw new HttpException(400, 'OrdinaryLoadInfo is not found.');

        }
        return $model;
    }

    /**
     * @throws StaleObjectException
     */
    public function update(OrdinaryLoad $model)
    {
        if (!$model->update()) {
            throw new \RuntimeException('Update error.');
        }
    }
}