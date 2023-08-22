<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\Action;

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

}