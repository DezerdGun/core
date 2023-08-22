<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\User;

class UserRepository
{
    public function getById($id): User
    {
        if (!$model = User::findOne(['id' => $id])) {
            throw new HttpException(404, 'User is not found.');
        }
        return $model;
    }

    public function update(User $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Updating error.');
        }
    }
}
