<?php

namespace api\khalsa\repositories;

use api\components\HttpException;
use common\models\ContactInfo;
use yii\db\StaleObjectException;
use \api\khalsa\interfaces\RepositoryInterface;

class ContactInfoRepository implements RepositoryInterface
{

    public function getById($id): ContactInfo
    {
        if (!$contactInfo = ContactInfo::findOne(['id' => $id])) {
            throw new HttpException(404, 'Contact info is not found.');
        }
        return $contactInfo;
    }

    /**
     * @throws StaleObjectException
     */
    public function delete(ContactInfo $contactInfo)
    {
        if (!$contactInfo->delete()) {
            throw new HttpException(500, 'Removing error.');
        }
    }

    public function create(ContactInfo $model)
    {
        if (!$model->save()) {
            throw new HttpException(500, 'Saving error.');
        }
    }

    public function update(ContactInfo $model)
    {
        if (!$model->save()) {
            throw new HttpException(500,'Updating error.');
        }
    }
}
