<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use common\models\Address;
use yii\db\StaleObjectException;

class AddressRepository implements RepositoryInterface
{
    public function getById($id): Address
    {
        if (!$model = Address::findOne(['id' => $id])) {
            throw new HttpException(404,'Address is not found.');
        }
        return $model;
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(Address $address)
    {
        if (!$address->delete()) {
            throw new HttpException(500,'Removing error.');
        }
    }

    public function create(Address $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Saving error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function update(Address $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Updating error.');
        }
    }
}
