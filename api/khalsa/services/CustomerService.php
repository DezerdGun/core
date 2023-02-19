<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\ContactInfoRepository;
use api\khalsa\repositories\CustomerRepository;
use common\models\Company;
use common\models\ContactInfo;
use common\models\Customer;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;

class CustomerService
{
    private $customerRepository;
    private $companyService;
    private $contactInfoService;
    private $contactInfoRepository;

    public function __construct
    (
        CustomerRepository $customerRepository,
        CompanyService $companyService,
        ContactInfoService $contactInfoService,
        ContactInfoRepository $contactInfoRepository
    )
    {
        $this->customerRepository = $customerRepository;
        $this->companyService = $companyService;
        $this->contactInfoService = $contactInfoService;
        $this->contactInfoRepository = $contactInfoRepository;
    }

    public function index()
    {

    }

    public function create()
    {
        $company = new Company();
        $this->companyService->create($company);

        $contactInfo = new ContactInfo();
        $contactInfo->scenario = ContactInfo::SCENARIO_CUSTOMER;
        $contactInfo = $this->contactInfoService->create($contactInfo);

        $model = new Customer();
        $model->company_id = $company->id;
        $model->contact_info_id = $contactInfo->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->customerRepository->create($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $model;

    }

    public function delete($id)
    {
        $model = $this->customerRepository->getById($id);
        $this->customerRepository->delete($model);
    }

    public function show($id)
    {
        return $this->customerRepository->getById($id);
    }

    /**
     * @throws HttpException
     * @throws InvalidConfigException
     * @throws StaleObjectException
     */
    public function update($id)
    {
        $model = $this->customerRepository->getById($id);

        $this->companyService->update($model->company);

        $contactInfo = $this->contactInfoRepository->getById($model->contact_info_id);
        $contactInfo->scenario = ContactInfo::SCENARIO_CUSTOMER;
        $this->contactInfoService->update($contactInfo);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->customerRepository->update($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }
}
