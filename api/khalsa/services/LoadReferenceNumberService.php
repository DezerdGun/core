<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\LoadReferenceNumberRepository;
use common\models\LoadReferenceNumber;

class LoadReferenceNumberService implements ServiceInterface
{
    public $loadReference;

    public function __construct(LoadReferenceNumberRepository $loadReference)
    {
        $this->loadReference = $loadReference;
    }

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

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }
}