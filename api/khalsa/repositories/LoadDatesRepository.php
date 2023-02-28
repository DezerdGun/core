<?php

namespace api\khalsa\repositories;

use api\khalsa\interfaces\RepositoryInterface;
use api\khalsa\NotFoundException;
use common\models\Date;
use yii\db\StaleObjectException;

class LoadDatesRepository implements RepositoryInterface
{

    public function getById($id): Date
    {
        if (!$model = Date::findOne(['id' => $id])) {
            throw new NotFoundException('Date is not found.');
        }
        return $model;
    }

    /**
     * @throws StaleObjectException
     */
    public function update(Date $model)
    {
        if (!$model->update()) {
            throw new \RuntimeException('Update date error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(Date $model)
    {
        if (!$model->delete()) {
            throw new \RuntimeException('Delete date error.');
        }
    }
}