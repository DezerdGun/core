<?php

namespace api\khalsa\services;

use api\forms\company\CompanyCreateForm;
use common\models\Address;
use api\khalsa\repositories\CompanyRepository;
use common\models\Company;
use Yii;
use api\components\HttpException;
use yii\db\StaleObjectException;

class CompanyService
{
    private $companyRepository;
    private $addressService;

    public function __construct
    (
        CompanyRepository $companyRepository,
        AddressService $addressService
    )
    {
        $this->companyRepository = $companyRepository;
        $this->addressService = $addressService;
    }

    public function create(CompanyCreateForm $form): Company
    {
        $address = $this->addressService->create();

        $model = new Company();
        $model->address_id = $address->id;
        $model->mc_number = $form->mc_number;
        $model->dot = $form->dot;
        $model->company_name = $form->company_name;
        $model->business_phone = $form->business_phone;
        $model->ein = $form->ein;

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

    /**
     * @throws StaleObjectException
     */
    public function update($id)
    {
        $model = $this->companyRepository->getById($id);

        $this->addressService->update($model->address_id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->companyRepository->update($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }

    }
}
