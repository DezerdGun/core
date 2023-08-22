<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use common\models\Location;
use yii\db\StaleObjectException;
use api\khalsa\NotFoundException;

class LocationRepository implements RepositoryInterface
{

    public function getById($id): Location
    {
        if (!$location = Location::findOne(['id' => $id])) {
            throw new HttpException(404, 'Location is not found.');
        }
        return $location;
    }

    public function create(Location $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Saving error.');
        }
    }

    public function update(Location $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Updating error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(Location $location)
    {
        if (!$location->delete()) {
            throw new HttpException(500, 'Removing error.');
        }
    }

}
