<?php

namespace api\khalsa\repositories\listing;

use common\models\ListingContainerAdditionalInfo;

class AdditionalInfoRepository
{
    public function create(ListingContainerAdditionalInfo $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}
