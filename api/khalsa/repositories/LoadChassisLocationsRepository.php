<?php

namespace api\khalsa\repositories;

use api\khalsa\interfaces\RepositoryInterface;
use api\khalsa\NotFoundException;
use common\models\Chassis_locations;
use yii\db\StaleObjectException;

class LoadChassisLocationsRepository implements RepositoryInterface
{

    public function getById($id): Chassis_locations
    {
        if (!$model = Chassis_locations::findOne(['id' => $id])) {
            throw new NotFoundException('ChassisLocation is not found.');
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
     */
    public function update(Chassis_locations $model)
    {
        if (!$model->update()) {
            throw new \RuntimeException('Update error.');
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