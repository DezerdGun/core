<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\forms\company\CompanyCreateForm;
use api\khalsa\repositories\CarrierRepository;
use common\models\Carrier;
use common\models\Company;
use yii\base\InvalidConfigException;

class CarrierService
{
    private $carrierRepository;
    private $companyService;

    public function __construct(CarrierRepository $repository, CompanyService $companyService)
    {
        $this->carrierRepository = $repository;
        $this->companyService = $companyService;
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function create(): Carrier
    {
        $company = new Company();
        $company->setScenario(Company::SCENARIO_CARRIER_CREATE);
        $company = $this->companyService->create($company);

        $model = new Carrier();
        $model->setScenario(Carrier::SCENARIO_INSERT);
        $model->company_id = $company->id;

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $this->carrierRepository->create($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $model;
    }
}
