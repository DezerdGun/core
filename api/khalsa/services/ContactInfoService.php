<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\ContactInfoRepository;
use common\models\ContactInfo;
use yii\db\StaleObjectException;
use Yii;
class ContactInfoService
{

    private $contactInfoRepository;

    public function __construct(ContactInfoRepository $repository)
    {
        $this->contactInfoRepository = $repository;
    }

    public function create(ContactInfo $model)
    {
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->contactInfoRepository->create($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $model;
    }

    /**
     * @throws StaleObjectException
     */
    public function delete($id)
    {
        $contactInfo = $this->repository->getById($id);
        $this->contactInfoRepository->delete($contactInfo);
    }

    public function update(ContactInfo $model)
    {

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->contactInfoRepository->update($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }
}
