<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\LoadDatesRepository;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;

class LoadDatesService implements ServiceInterface
{

    public $loadDatesRepository;
    /**
     * @var LoadDatesRepository
     */
    public function __construct(LoadDatesRepository $loadDatesRepository)
    {
        $this->loadDatesRepository = $loadDatesRepository;
    }
    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * @throws StaleObjectException
     */
    public function delete($id)
    {
        $model = $this->loadDatesRepository->getById($id);
        $this->loadDatesRepository->delete($model);
    }

    /**
     * @throws StaleObjectException
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function update($id)
    {
        $model = $this->loadDatesRepository->getById($id);
        $model->load(\Yii::$app->request->post(),'Date');
        if ($model->validate()) {
            $this->loadDatesRepository->update($model);
        } else throw new HttpException(400, [$model->formName() => $model->getErrors()]);
    }
}