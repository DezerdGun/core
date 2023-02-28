<?php

namespace api\khalsa\repositories;

use api\khalsa\interfaces\RepositoryInterface;
use api\khalsa\NotFoundException;
use common\models\Container_return;
use yii\db\StaleObjectException;

class LoadContainerReturnRepository implements RepositoryInterface
{

    public function getById($id): Container_return
    {
        if (!$model = Container_return::findOne(['id' => $id])) {
            throw new NotFoundException('ContainerReturn is not found.');
        }
        return $model;
    }

    public function create(Container_return $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function update($model)
    {
        if (!$model->update()) {
            throw new \RuntimeException('Updating error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(Container_return $model)
    {
        if (!$model->delete()) {
            throw new \RuntimeException('Deleting error.');
        }
    }
}