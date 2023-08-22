<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\forms\billing\BillingDetailForm;
use api\khalsa\repositories\BillingDetailRepository;
use common\models\Billing;
use common\models\BillingDetail;

class BillingDetailService
{
    public $repository;
    public function __construct(BillingDetailRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws HttpException
     */
    public function create(BillingDetailForm $form)
    {

        foreach ($form->charge_id as $key => $value) {
            $model = new BillingDetail();
            $model->billing_id = $form->billing_id;
            $model->charge_id = $value;
            $model->description = $form->description[$key];
            $model->price = $form->price[$key];
            $model->unit_count = $form->unit_count[$key];
            $model->measure_id = $form->measure_id[$key];
            $model->free_unit = $form->free_unit[$key];
            $model->per_unit = $form->per_unit[$key];
            $this->repository->create($model);
        }
    }

    /**
     * @throws HttpException
     */
    public function delete($ids)
    {
        $billing_detail_ids = explode(',', $ids);
        foreach ($billing_detail_ids as $billing_detail_id) {
            $model = $this->repository->getById($billing_detail_id);
            $this->repository->delete($model);
        }
    }

    /**
     * @throws HttpException
     */
    public function update(BillingDetailForm $form, $id)
    {
        $ids = explode(',', $id);
        foreach ($ids as $key => $value) {
            $model = $this->repository->getById($value);
            $model->charge_id = $form->charge_id[$key];
            $model->price = $form->price[$key];
            $model->free_unit = $form->free_unit[$key];
            $model->per_unit = $form->per_unit[$key];
            $model->description = $form->description[$key];
            $model->unit_count = $form->unit_count[$key];
            $model->measure_id = $form->measure_id[$key];
            $this->repository->update($model);
        }
    }
}