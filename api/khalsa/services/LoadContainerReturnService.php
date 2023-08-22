<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\LoadContainerReturnRepository;
use common\models\Container_return;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;

class LoadContainerReturnService implements ServiceInterface
{
    public $ContainerReturnRepository;
    /**
     * @var LoadContainerReturnRepository
     */
    public function __construct(LoadContainerReturnRepository $ContainerReturnRepository)
    {
        $this->ContainerReturnRepository = $ContainerReturnRepository;
    }

    /**
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function create(): Container_return
    {
        $model = new Container_return();
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->ContainerReturnRepository->create($model);
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
        $model = $this->ContainerReturnRepository->getById($id);
        $this->ContainerReturnRepository->delete($model);
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function update($id)
    {
        $model = $this->ContainerReturnRepository->getById($id);
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->ContainerReturnRepository->update($model);
        } else throw new HttpException(400, [$model->formName() => $model->getErrors()]);
    }
}