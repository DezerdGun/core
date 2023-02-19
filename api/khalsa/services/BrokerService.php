<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\BrokerRepository;
use common\models\Broker;
use common\models\Company;
use common\models\User;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;

class BrokerService
{
    public $brokerRepository;
    public $companyService;
    public $userService;

    public function __construct
    (
        BrokerRepository $brokerRepository,
        CompanyService $companyService,
        UserService $userService
    )
    {
        $this->brokerRepository = $brokerRepository;
        $this->companyService = $companyService;
        $this->userService = $userService;
    }

    /**
     * @throws StaleObjectException
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function update($id)
    {
        $model = $this->brokerRepository->getByUserId($id);

        $user = $model->user;
        $this->userService->update($user);

        if ($model->company_id) {
            $this->companyService->update($model->company);
        } else {
            $company = new Company();
            $this->companyService->create($company);
            $model->company_id = $company->id;
        }

        $this->brokerRepository->create($model);
    }

    public function show($user_id): Broker
    {
        return $this->brokerRepository->getByUserId($user_id);
    }

}
