<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\LoadOrdinaryDescriptionRepository;
use common\models\LoadOrdinaryDescription;
use yii\base\InvalidConfigException;

class LoadOrdinaryDescriptionService implements ServiceInterface
{
    public $loadOrdinaryDescription;

    public function __construct(LoadOrdinaryDescriptionRepository $loadOrdinaryDescription)
    {
        $this->loadOrdinaryDescription = $loadOrdinaryDescription;
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function create(): LoadOrdinaryDescription
    {
        $model = new LoadOrdinaryDescription();
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->loadOrdinaryDescription->create($model);
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