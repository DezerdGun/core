<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\ActionRepository;
use api\khalsa\repositories\LogRepository;
use common\helpers\DateTime;
use common\models\Log;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class LogService
{
    public $logRepository;
    public $actionRepository;

    public function __construct
    (
        LogRepository $logRepository,
        ActionRepository $actionRepository
    )
    {
        $this->logRepository = $logRepository;
        $this->actionRepository = $actionRepository;
    }


    /**
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function create(array $data, $action): Log
    {
        $model = new Log();
        $model->action_id = $this->actionRepository->getByName($action)->id;
        $model->user_id = \Yii::$app->user->id;
        $model->action_date = time();
        $model->detail = serialize($data);
        $this->logRepository->create($model);
        return $model;
    }

    /**
     * @throws HttpException
     */
    public function view($ids): array
    {
        return $this->logRepository->getByIds($ids);
    }
}