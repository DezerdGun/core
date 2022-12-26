<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\LocationRepository;
use common\models\ContactInfo;
use yii\db\StaleObjectException;


class LocationService implements ServiceInterface
{

    private $locationRepository;

    public function __construct(LocationRepository $repository)
    {
        $this->locationRepository = $repository;
    }


    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * @throws StaleObjectException
     */
    public function delete($id)
    {
       $location = $this->locationRepository->getById($id);
       $this->locationRepository->delete($location);
    }

    public function update($id)
    {
        $model = $this->locationRepository->getById($id);
        $model->scenario = 'update';
        $address = $model->address;
        $contactInfo = $model->contactInfo;
        $transaction = Yii::$app->db->beginTransaction();
        if (!($address->load(\Yii::$app->getRequest()->post(), 'Address') && $address->save())) {
            throw new HttpException(400, [$address->formName() => $address->getErrors()]);
        }

        if (!$contactInfo) {
            $contactInfo = new ContactInfo();
        }

        if (!($contactInfo->load(\Yii::$app->getRequest()->post(), 'ContactInfo') && $contactInfo->save())) {
            throw new HttpException(400, [$contactInfo->formName() => $contactInfo->getErrors()]);
        }

        if (!($model->load($this->getAllowedPost(), 'Location') && $model->validate())) {
            $model->contact_info_id = $contactInfo->id;
            $model->save();
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }

        $transaction->commit();
    }
}
