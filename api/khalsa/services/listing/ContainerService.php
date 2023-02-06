<?php

namespace api\khalsa\services\listing;

use api\components\HttpException;
use api\forms\listing\ListingContainerForm;
use api\khalsa\repositories\listing\ContainerRepository;
use common\enums\ListingStatus;
use common\models\ListingContainer;

class ContainerService
{
    public $containerRepository;
    public function __construct
    (
        ContainerRepository $containerRepository
    )
    {
        $this->containerRepository = $containerRepository;
    }

    public function create(): ListingContainer
    {
        $model = new ListingContainer();

        $model->setAttributes(\Yii::$app->request->post());
        $model->user_id = \Yii::$app->user->id;
        $model->status = ListingStatus::ACTIVE;
        if ($model->validate()) {
            $this->containerRepository->create($model);
        } else {
            throw new HttpException(400, ['ListingContainer' => $model->getErrors()]);
        }
        return $model;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update($id)
    {
        $model = $this->containerRepository->getById($id);
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->containerRepository->update($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }

    public function updateStatus()
    {
        $form = new ListingContainerForm();

        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
            $this->containerRepository->updateStatus($form);
        } else {
            throw new HttpException(400, [$form->formName() => $form->getErrors()]);
        }
    }
}
