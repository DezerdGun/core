<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\LoadContainerInfoRepository;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;

class LoadContainerInfoService implements ServiceInterface
{
    public $loadContainerInfoRepository;
    /**
     * @var LoadContainerInfoRepository
     */
    public function __construct(LoadContainerInfoRepository $loadContainerInfoRepository)
    {
        $this->loadContainerInfoRepository = $loadContainerInfoRepository;
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @throws HttpException
     * @throws InvalidConfigException
     * @throws StaleObjectException
     */
    public function update($id)
    {
        $model = $this->loadContainerInfoRepository->getById($id);
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->loadContainerInfoRepository->update($model);
        } else throw new HttpException(400, [$model->formName() => $model->getErrors()]);
    }
}