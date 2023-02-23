<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\LoadOrdinaryReferenceNumberRepository;
use common\models\LoadOrdinaryReferenceNumber;
use yii\base\InvalidConfigException;

class LoadOrdinaryReferenceNumberService implements  ServiceInterface
{
    public $loadOrdinaryReferenceNumberRepository;

    public function __construct(LoadOrdinaryReferenceNumberRepository $loadOrdinaryReferenceNumberRepository)
    {
        $this->loadOrdinaryReferenceNumberRepository = $loadOrdinaryReferenceNumberRepository;
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function create(): LoadOrdinaryReferenceNumber
    {
        $model = new LoadOrdinaryReferenceNumber();
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->loadOrdinaryReferenceNumberRepository->create($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $model;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function update($id)
    {
        $model = $this->loadOrdinaryReferenceNumberRepository->getById($id);
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->loadOrdinaryReferenceNumberRepository->update($model);
        } else throw new HttpException(400, [$model->formName() => $model->getErrors()]);
    }
}