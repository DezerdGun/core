<?php

namespace api\khalsa\services\listing;

use api\components\HttpException;
use api\khalsa\repositories\listing\ContainerInfoRepository;
use common\models\ListingContainerInfo;
use yii\base\InvalidConfigException;

class ContainerInfoService
{
    public $containerInfoRepository;

    public function __construct(ContainerInfoRepository $containerInfoRepository)
    {
        $this->containerInfoRepository = $containerInfoRepository;
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function create(): ListingContainerInfo
    {
        $model = new ListingContainerInfo();
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->containerInfoRepository->create($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $model;
    }
}
