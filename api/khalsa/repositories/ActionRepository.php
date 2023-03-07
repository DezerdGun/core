<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\Action;
use common\models\Log;

class ActionRepository
{
    /**
     * @throws HttpException
     */
    public function getByName($name): Action
    {
        if (!$model = Action::findOne(['name' => $name])) {
            throw new HttpException(404, 'Action is not found.');
        }
        return $model;
    }

    /**
     * @throws HttpException
     */
    public function create(Log $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Saving error.');
        }
    }
}