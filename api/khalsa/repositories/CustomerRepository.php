<?php

namespace api\khalsa\repositories;

use common\models\Customer;
use api\khalsa\NotFoundException;
use yii\db\StaleObjectException;

class CustomerRepository
{
    public function getById($id): Customer
    {
        if (!$model = Customer::findOne(['id' => $id])) {
            throw new NotFoundException('Customer is not found.');
        }
        return $model;
    }

    public function create(Customer $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(Customer $model)
    {
        if (!$model->delete())
        {
            throw new \RuntimeException('Removing error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function update(Customer $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Updating error.');
        }
    }
}
