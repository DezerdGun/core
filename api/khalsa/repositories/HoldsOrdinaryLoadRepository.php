<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use common\models\OrdinaryHolds;
use common\models\OrdinaryHoldsHistory;

class HoldsOrdinaryLoadRepository implements RepositoryInterface
{

    public function getById($id): OrdinaryHolds
    {
        if (!$model = OrdinaryHolds::findOne(['load_id' => $id])) {
            throw new HttpException(400, 'OrdinaryHolds is not found.');
        }
        return $model;
    }

    public function update(OrdinaryHolds $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Updating error.');
        }
    }
}