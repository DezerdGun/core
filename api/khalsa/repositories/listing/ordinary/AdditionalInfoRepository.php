<?php

namespace api\khalsa\repositories\listing\ordinary;

use common\models\ListingOrdinaryAdditionalInfo;

class AdditionalInfoRepository implements \api\khalsa\interfaces\RepositoryInterface
{
    public function create(ListingOrdinaryAdditionalInfo $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }
}
