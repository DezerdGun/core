<?php

namespace api\khalsa\repositories;

use common\models\Company;
use yii\db\StaleObjectException;

class CompanyRepository
{
    public function getById($id): Company
    {
        if (!$model = Company::findOne(['id' => $id])) {
            throw new NotFoundException('Company is not found.');
        }
        return $model;
    }

    public function create(Company $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function update(Company $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Updating error.');
        }
    }

}
