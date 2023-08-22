<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use api\khalsa\NotFoundException;
use common\models\Chassis_locations;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

class LoadChassisLocationsRepository implements RepositoryInterface
{

    public function getById($id): Chassis_locations
    {
        if (!$model = Chassis_locations::findOne(['load_id' => $id])) {
            throw new HttpException(400, 'ChassisLocation is not found.');

        }
        return $model;
    }

    public function create(Chassis_locations $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @throws StaleObjectException
     * @throws HttpException
     */
    public function update(Chassis_locations $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Saving error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(Chassis_locations $model)
    {
        if (!$model->delete()) {
            throw new \RuntimeException('Delete error.');
        }
    }
}