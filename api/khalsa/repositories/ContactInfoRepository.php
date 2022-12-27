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
}
