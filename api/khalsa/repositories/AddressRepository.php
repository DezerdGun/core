<?php

namespace api\khalsa\repositories;

use api\khalsa\interfaces\RepositoryInterface;
use common\models\Address;
use yii\db\StaleObjectException;

class AddressRepository implements RepositoryInterface
{
    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(Address $address)
    {
        if (!$address->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
