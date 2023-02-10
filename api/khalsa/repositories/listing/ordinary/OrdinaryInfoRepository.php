<?php

namespace api\khalsa\repositories\listing\ordinary;

use api\khalsa\interfaces\RepositoryInterface;
use common\models\ListingOrdinaryInfo;

class OrdinaryInfoRepository implements RepositoryInterface
{
    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function create(ListingOrdinaryInfo $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}
