<?php

namespace api\khalsa\services\listing\ordinary;

use api\components\HttpException;
use api\khalsa\repositories\listing\ordinary\AdditionalInfoRepository;
use common\models\ListingOrdinaryAdditionalInfo;

class OrdinaryAdditionalInfo implements \api\khalsa\interfaces\ServiceInterface
{
    public $additionalInfoRepository;

    public function __construct
    (
        AdditionalInfoRepository $additionalInfoRepository
    )
    {
        $this->additionalInfoRepository = $additionalInfoRepository;
    }

    public function create()
    {
        $model = new ListingOrdinaryAdditionalInfo();
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->additionalInfoRepository->create($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }
}
