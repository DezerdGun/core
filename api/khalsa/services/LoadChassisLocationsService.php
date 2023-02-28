<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\LoadChassisLocationsRepository;
use common\models\Chassis_locations;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;

class LoadChassisLocationsService implements ServiceInterface
{
    public $chassisLocationsRepository;
    /**
     * @var LoadChassisLocationsRepository
     */
    public function __construct(LoadChassisLocationsRepository $chassisLocationsRepository)
    {
        $this->chassisLocationsRepository = $chassisLocationsRepository;
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function create(): Chassis_locations
    {
        $model = new Chassis_locations();
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->chassisLocationsRepository->create($model);
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
        $model = $this->chassisLocationsRepository->getById($id);
        $this->chassisLocationsRepository->delete($model);
    }

    /**
     * @throws StaleObjectException
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function update($id)
    {
        $model = $this->chassisLocationsRepository->getById($id);
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->chassisLocationsRepository->update($model);
        } else throw new HttpException(400, [$model->formName() => $model->getErrors()]);
    }
}