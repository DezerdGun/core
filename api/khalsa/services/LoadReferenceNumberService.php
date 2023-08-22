<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\LoadReferenceNumberRepository;
use common\models\LoadReferenceNumber;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;

class LoadReferenceNumberService implements ServiceInterface
{
    public $loadReference;

    public function __construct(LoadReferenceNumberRepository $loadReference)
    {
        $this->loadReference = $loadReference;
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function create():LoadReferenceNumber
    {
        $model = new LoadReferenceNumber();
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->loadReference->create($model);
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
        $model = $this->loadReference->getById($id);
        $this->loadReference->delete($model);
    }

    /**
     * @throws StaleObjectException
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function update($id)
    {
        $model = $this->loadReference->getById($id);
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->loadReference->update($model);
        } else throw new HttpException(400, [$model->formName() => $model->getErrors()]);
    }
}