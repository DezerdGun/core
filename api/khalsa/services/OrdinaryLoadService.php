<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\OrdinaryLoadRepository;
use common\models\OrdinaryLoad;

class OrdinaryLoadService
{
    public $repository;
    public function __construct(OrdinaryLoadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @throws HttpException
     */
    public function update(OrdinaryLoad $model)
    {
        if ($model->validate()) {
            $this->repository->update($model);
        } else {
            throw new HttpException(400, [$model->errors]);
        }
    }
}