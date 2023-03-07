<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\ActionRepository;
use common\helpers\DateTime;
use common\models\Log;

class LogService
{
    public $actionRepository;
    public function __construct
    (
        ActionRepository $actionRepository
    )
    {
        $this->actionRepository = $actionRepository;
    }

    /**
     * @throws HttpException
     */
    public function create(array $data, $action)
    {
        $model = new Log();
        $model->action_id = $this->actionRepository->getByName()->id;
        $model->user_id = \Yii::$app->user->id;
        $model->action_date = DateTime::setLocalTimestamp();
        $model->detail = serialize($data);
        $this->actionRepository->create();
    }
}