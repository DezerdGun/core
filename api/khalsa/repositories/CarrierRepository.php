<?php

namespace api\khalsa\repositories;

use common\models\Carrier;

class CarrierRepository
{
    public function create(Carrier $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}
