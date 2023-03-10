<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\HoldsLoadContainerInfoRepository;
use common\models\Holds;
use yii\base\InvalidConfigException;

class HoldsLoadContainerInfoService implements ServiceInterface
{
    public $holdsLoadContainerInfoRepository;
    public $holds;
    public function __construct(HoldsLoadContainerInfoRepository $holdsLoadContainerInfoRepository,  Holds $holds)
    {
        $this->holdsLoadContainerInfoRepository = $holdsLoadContainerInfoRepository;
        $this->holds = $holds;
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function create(): Holds
    {
        $model = new Holds();
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->holdsLoadContainerInfoRepository->create($model);
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
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function update($load_id)
    {
        $name = \Yii::$app->user->identity->username;
        $model = $this->holdsLoadContainerInfoRepository->getById($load_id);
        $model->setAttributes(\Yii::$app->request->post());
        $model->changeWriterHolds($model,$name);
         if ($model->validate()) {
            $this->holdsLoadContainerInfoRepository->update($model);
        } else throw new HttpException(400, [$model->formName() => $model->getErrors()]);

    }
}