<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use common\models\Date;
use yii\db\StaleObjectException;

class LoadDatesRepository implements RepositoryInterface
{

    public function getById($id): Date
    {
        if (!$model = Date::findOne(['load_id' => $id])) {
            throw new HttpException(400, 'Date is not found.');
        }
        return $model;
    }

    /**
     * @throws StaleObjectException
     */
    public function update(Date $model)
    {
        if (!$model->update()) {
            throw new HttpException(400, [$model->formName() => $model->errors]);
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