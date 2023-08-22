<?php

namespace api\khalsa\repositories\listing;

use api\components\HttpException;
use api\forms\listing\ListingContainerForm;
use common\models\ListingContainer;

class ContainerRepository implements \api\khalsa\interfaces\RepositoryInterface
{

    public function getById($id): ListingContainer
    {
        if (!$model = ListingContainer::findOne(['id' => $id])) {
            throw new HttpException(404,'Listing container is not found.');
        }
        return $model;
    }

    public function create(ListingContainer $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Saving error.');
        }
    }

    public function update(ListingContainer $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Updating error.');
        }
    }

    public function updateStatus(ListingContainerForm $form)
    {
        ListingContainer::updateAll(['status' => $form->status], ['in', 'id', $form->id]);
    }
}
