<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\Company;
use yii\db\StaleObjectException;

class CompanyRepository
{
    public function getById($id): Company
    {
        if (!$model = Company::findOne(['id' => $id])) {
            throw new HttpException(404,'Company is not found.');
        }
        return $model;
    }

    public function create(Company $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Saving error.');
        }
    }

    /**
     * @throws StaleObjectException
     */
    public function update(Company $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Updating error.');
        }
    }

}
