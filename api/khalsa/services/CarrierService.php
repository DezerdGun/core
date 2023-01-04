<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\forms\carrier\CarrierCreateForm;
use api\khalsa\repositories\CarrierRepository;
use common\models\Carrier;
use common\models\Company;
use Yii;

class CarrierService
{
    private $carrierRepository;

    public function __construct(CarrierRepository $repository)
    {
        $this->carrierRepository = $repository;
    }

    public function create(Company $company, CarrierCreateForm $form): Carrier
    {
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
