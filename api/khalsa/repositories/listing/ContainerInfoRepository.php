<?php

namespace api\khalsa\repositories\listing;

use common\models\ListingContainerInfo;

class ContainerInfoRepository
{
    public function create(ListingContainerInfo $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}
