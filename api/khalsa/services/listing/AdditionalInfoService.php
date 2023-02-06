<?php

namespace api\khalsa\services\listing;

use api\components\HttpException;
use api\forms\listing\AdditionalInfoCreateForm;
use api\khalsa\repositories\listing\AdditionalInfoRepository;
use api\khalsa\repositories\listing\ContainerRepository;
use common\models\ListingContainerAdditionalInfo;
use Yii;
use yii\base\InvalidConfigException;

class AdditionalInfoService
{
    public $additionalInfoRepository;
    public $containerRepository;

    public function __construct
    (
        AdditionalInfoRepository $additionalInfoRepository,
        ContainerRepository $containerRepository
    )
    {
        $this->additionalInfoRepository = $additionalInfoRepository;
        $this->containerRepository = $containerRepository;
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function create(): ListingContainerAdditionalInfo
    {
        $model = new ListingContainerAdditionalInfo();
        $model->setAttributes(Yii::$app->request->post());

        if ($model->validate()) {
            $this->additionalInfoRepository->create($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $model;
    }
}
