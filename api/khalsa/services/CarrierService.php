<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\forms\company\CompanyCreateForm;
use api\khalsa\repositories\CarrierRepository;
use common\models\Carrier;
use common\models\Company;
use yii\base\InvalidConfigException;
use Yii;
class CarrierService
{
    private $carrierRepository;
    private $companyService;
    private $userService;

    public function __construct
    (
        CarrierRepository $repository,
        CompanyService $companyService,
        UserService $userService
    )
    {
        $this->carrierRepository = $repository;
        $this->companyService = $companyService;
        $this->userService = $userService;
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function createCompany()
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
    }

    public function update()
    {
        $model = $this->carrierRepository->getByUserId(\Yii::$app->user->id);

        $company = $model->company;
        $company->setScenario(Company::SCENARIO_CARRIER_UPDATE);
        $this->companyService->update($company);

        $user = $model->user;
        $this->userService->update($user);

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $this->carrierRepository->update($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }

    public function show()
    {
        $user_id = \Yii::$app->user->id;
        return $this->carrierRepository->getByUserId(['user_id' => $user_id]);
    }

    public function updateW9()
    {
        $model = $this->carrierRepository->getByUserId(Yii::$app->user->id);

        unlink(Yii::getAlias('@cdn-webroot') . '/' . $model->w9_file);

        $model->setScenario(Carrier::SCENARIO_UPDATE_W9);

        if ($model->validate()) {
            $this->carrierRepository->update($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }

    public function updateIc()
    {
        $model = $this->carrierRepository->getByUserId(Yii::$app->user->id);

        unlink(Yii::getAlias('@cdn-webroot') . '/' . $model->ic_file);

        $model->setScenario(Carrier::SCENARIO_UPDATE_IC);

        if ($model->validate()) {
            $this->carrierRepository->update($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }

    }
}
