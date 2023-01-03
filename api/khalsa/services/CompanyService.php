<?php

namespace api\khalsa\services;

use api\forms\carrier\CarrierCreateForm;
use api\forms\company\CompanyCreateForm;
use common\models\Address;
use api\khalsa\repositories\CompanyRepository;
use common\models\Company;
use Yii;
use api\components\HttpException;

class CompanyService
{
    private $companyRepository;

    public function __construct(CompanyRepository $repository)
    {
        $this->companyRepository = $repository;
    }

    public function create(Address $address, CarrierCreateForm $form): Company
    {
        $model = new Company();
        $model->address_id = $address->id;
        $model->mc_number = $form->mc_number;
        $model->dot = $form->dot;
        $model->company_name = $form->company_name;

        if ($model->validate()) {
            $this->companyRepository->create($model);
        } else {
            throw new HttpException(400, ['Company' => $model->getErrors()]);
        }
        return $model;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }
}
