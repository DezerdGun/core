<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\Customer;
use api\khalsa\NotFoundException;
use yii\db\StaleObjectException;

class CustomerRepository
{
    public function getById($id): Customer
    {
        if (!$model = Customer::findOne(['id' => $id])) {
            throw new HttpException(404, 'Customer is not found.');
        }
        return $model;
    }

    public function create(Customer $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Saving error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(Customer $model)
    {
        if (!$model->delete())
        {
            throw new HttpException(500, 'Removing error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function update(Customer $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Updating error.');
        }
    }
}
