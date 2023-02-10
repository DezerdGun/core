<?php

namespace api\khalsa\repositories\listing\ordinary;

use api\forms\listing\ordinary\UpdateStatusForm;
use common\models\ListingOrdinary;

class OrdinaryRepository implements \api\khalsa\interfaces\RepositoryInterface
{
    public function getById($id): ListingOrdinary
    {
        if (!$model = ListingOrdinary::findOne(['id' => $id])) {
            throw new NotFoundException('Listing ordinary is not found.');
        }
        return $model;
    }

    public function create(ListingOrdinary $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function updateStatus(UpdateStatusForm $form)
    {
        ListingOrdinary::updateAll(['status' => $form->status], ['in', 'id', $form->id]);
    }

    public function update(ListingOrdinary $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Updating error.');
        }
    }
}
