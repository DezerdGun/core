<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\forms\billing\BillingCreateForm;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\ContainerLoadRepository;
use common\models\Billing;
use common\models\Load;

class ContainerLoadService
{
    public $repository;
    public function __construct(ContainerLoadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {

    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }


    /**
     * @throws HttpException
     */
    public function update(Load $model)
    {
        if ($model->validate()) {
            $this->repository->update($model);
        } else {
            throw new HttpException(400, [$model->errors]);
        }
    }

}