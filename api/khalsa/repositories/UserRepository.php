<?php

namespace api\khalsa\repositories;

use common\models\User;

class UserRepository
{
    public function getById($id): User
    {
        if (!$model = User::findOne(['id' => $id])) {
            throw new NotFoundException('Company is not found.');
        }
        return $model;
    }

    public function update(User $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Updating error.');
        }
    }
}
