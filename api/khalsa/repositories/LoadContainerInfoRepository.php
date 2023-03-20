<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use api\khalsa\NotFoundException;
use common\models\LoadContainerInfo;
use yii\db\StaleObjectException;

class LoadContainerInfoRepository implements RepositoryInterface
{

    public function getById($id): LoadContainerInfo
    {
        if (!$model = LoadContainerInfo::findOne(['load_id' => $id])) {
            throw new HttpException(400, 'LoadContainerInfo is not found.');
        }
        return $model;
    }

    /**
     * @throws StaleObjectException
     */
    public function update(LoadContainerInfo $model)
    {
        if (!$model->update()) {
            throw new \RuntimeException('Update error.');
        }
    }
}