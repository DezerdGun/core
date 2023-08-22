<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use api\khalsa\interfaces\RepositoryInterface;
use common\models\Billing;
use common\models\BillingDetail;
use yii\db\ActiveQuery;
use yii\db\StaleObjectException;

class BillingRepository implements RepositoryInterface
{

    /**
     * @throws HttpException
     */
    public function getById($id): Billing
    {
        if (!$model = Billing::findOne(['id' => $id])) {
            throw new HttpException(404, 'Billing is not found');
        }
        return $model;
    }

    /**
     * @throws HttpException
     */
    public function create(Billing $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Saving error.');
        }
    }

    /**
     * @throws HttpException
     */
    public function getWithDetail($id): ActiveQuery
    {
        return Billing::find()
            ->from(['billing' => Billing::tableName()])
            ->where(['billing.id' => $id])
            ->joinWith([
                'billingDetails' => function (ActiveQuery $query) {
                   $query->from(['billingDetail' => BillingDetail::tableName()]);
                }]);
    }

    /**
     * @throws StaleObjectException
     * @throws HttpException
     */
    public function update(Billing $model)
    {
        if (!$model->update()) {
            throw new HttpException(500,'Saving error.');
        }
    }
}