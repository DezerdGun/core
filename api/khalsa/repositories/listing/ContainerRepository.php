<?php

namespace api\khalsa\repositories\listing;

use api\forms\listing\ListingContainerForm;
use common\models\ListingContainer;

class ContainerRepository implements \api\khalsa\interfaces\RepositoryInterface
{

    public function getById($id): ListingContainer
    {
        if (!$model = ListingContainer::findOne(['id' => $id])) {
            throw new NotFoundException('Listing container is not found.');
        }
        return $model;
    }

    public function create(ListingContainer $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function update(ListingContainer $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Updating error.');
        }
    }

    public function updateStatus(ListingContainerForm $form)
    {
        ListingContainer::updateAll(['status' => $form->status], ['in', 'id', $form->id]);
    }
}
