<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\BillingRepository;
use common\models\Billing;
use Yii;

class BillingService
{
    public $repository;

    public function __construct(BillingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws HttpException
     */
    public function create(Billing $model): Billing
    {
        if ($model->validate()) {
            $this->repository->create($model);
        } else {
            throw new HttpException(400, $model->errors);
        }

        return $model;
    }

    /**
     * @throws HttpException
     */
    public function update(Billing $model)
    {
        if ($model->validate()) {
            $this->repository->update($model);
        } else {
            throw new HttpException(400, $model->errors);
        }
    }
}