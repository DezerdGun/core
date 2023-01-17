<?php

namespace api\khalsa\repositories;

use common\models\ContactInfo;
use yii\db\StaleObjectException;
use \api\khalsa\interfaces\RepositoryInterface;

class ContactInfoRepository implements RepositoryInterface
{

    public function getById($id): ContactInfo
    {
        if (!$contactInfo = ContactInfo::findOne(['id' => $id])) {
            throw new NotFoundException('Contact info is not found.');
        }
        return $contactInfo;
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(ContactInfo $contactInfo)
    {
        if (!$contactInfo->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function create(ContactInfo $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function update(ContactInfo $model)
    {
        if (!$model->save()) {
            throw new \RuntimeException('Updating error.');
        }
    }
}
