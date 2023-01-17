<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\forms\company\CompanyCreateForm;
use api\khalsa\repositories\CarrierRepository;
use common\models\Carrier;

class CarrierService
{
    private $carrierRepository;
    private $companyService;

    public function __construct(CarrierRepository $repository, CompanyService $companyService)
    {
        $this->carrierRepository = $repository;
        $this->companyService = $companyService;
    }

    public function create(CompanyCreateForm $form): Carrier
    {

        $company = $this->companyService->create($form);

        $model = new Carrier();
        $model->setScenario(Carrier::SCENARIO_INSERT);
        $model->user_id = $form->user_id;
        $model->company_id = $company->id;

        if ($model->validate()) {
            $this->carrierRepository->create($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $model;
    }
}
