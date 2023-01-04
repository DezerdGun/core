<?php

namespace api\khalsa\repositories;

use common\models\Company;

class CompanyRepository
{
    public function create(Company $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
