<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use common\models\BillingDetail;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;

class BillingDetailRepository implements RepositoryInterface
{

    public function getById($id): BillingDetail
    {
        if (!$model = BillingDetail::findOne(['id' => $id])) {
            throw new HttpException(404, 'Billing detail is not found.');
        }
        return $model;
    }

    public function create(BillingDetail $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Saving error.');
        }
    }

    /**
     * @throws StaleObjectException
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function delete(BillingDetail $model)
    {
        if (!$model->delete()) {
            throw new HttpException(500, [$model->formName() => $model->errors]);
        }
    }

    public function update(BillingDetail $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, [$model->errors]);
        }
    }
}