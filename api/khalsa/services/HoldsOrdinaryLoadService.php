<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\HoldsOrdinaryLoadRepository;
use yii\base\InvalidConfigException;

class HoldsOrdinaryLoadService implements ServiceInterface
{

    public HoldsOrdinaryLoadRepository $holdsOrdinaryLoadRepository;
    public function __construct(HoldsOrdinaryLoadRepository $holdsOrdinaryLoadRepository)
    {
        $this->holdsOrdinaryLoadRepository = $holdsOrdinaryLoadRepository;
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
     */
    public function update($id)
    {
        $name = \Yii::$app->user->identity->username;
        $model = $this->holdsOrdinaryLoadRepository->getById($id);
        $model->setAttributes(\Yii::$app->request->post());
        $model->changeWriterHolds($model,$name);
        if ($model->validate()) {
            $this->holdsOrdinaryLoadRepository->update($model);
        } else throw new HttpException(400, [$model->formName() => $model->getErrors()]);
    }
}