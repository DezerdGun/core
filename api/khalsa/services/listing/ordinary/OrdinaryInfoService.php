<?php

namespace api\khalsa\services\listing\ordinary;

use api\components\HttpException;
use api\khalsa\repositories\listing\ordinary\OrdinaryInfoRepository;
use common\models\ListingOrdinaryInfo;

class OrdinaryInfoService
{
    public $ordinaryInfoRepository;

    public function __construct
    (
        OrdinaryInfoRepository $ordinaryInfoRepository
    )
    {
        $this->ordinaryInfoRepository = $ordinaryInfoRepository;
    }

    public function create()
    {
        $model = new ListingOrdinaryInfo();
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->ordinaryInfoRepository->create($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }
}
