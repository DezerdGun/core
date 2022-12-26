<?php

namespace api\khalsa\repositories;

use api\khalsa\interfaces\RepositoryInterface;
use common\models\ContactInfo;
use common\models\Location;
use yii\db\StaleObjectException;

class LocationRepository implements RepositoryInterface
{

    public function getById($id): Location
    {
        if (!$location = Location::findOne(['id' => $id])) {
            throw new NotFoundException('Location is not found.');
        }
        return $location;
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(Location $location)
    {
        if (!$location->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
