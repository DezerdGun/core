<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\Log;
use yii\base\InvalidConfigException;

class LogRepository
{
    /**
     * @throws HttpException
     */
    public function getByIds($ids): array
    {
        if (!$models = Log::find()->filterWhere(['in', 'id', $ids])->all()) {
            throw new HttpException(404, 'Log is not found.');
        }
        return $models;
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function create(Log $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, [$model->formName() => $model->errors]);
        }
    }

}