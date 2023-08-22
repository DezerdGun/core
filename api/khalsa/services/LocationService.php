<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\LocationRepository;
use common\models\ContactInfo;
use common\models\Location;
use yii\db\StaleObjectException;
use Yii;

class LocationService implements ServiceInterface
{

    private $locationRepository;
    private $addressService;
    private $contactInfoService;
    public function __construct
    (
        LocationRepository $locationRepository,
        AddressService $addressService,
        ContactInfoService $contactInfoService
    )
    {
        $this->locationRepository = $locationRepository;
        $this->addressService = $addressService;
        $this->contactInfoService = $contactInfoService;
    }


    public function create()
    {
        $model = new Location();
        $address = $this->addressService->create();

        $model->address_id = $address->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->locationRepository->create($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $model;
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

        $this->addressService->update($model->address_id);

        if ($model->contact_info_id) {
            $this->contactInfoService->update($model->contactInfo);
        } else {
            $request = Yii::$app->request->post();
            $isEmpty = true;
            foreach ($request['ContactInfo'] as $index => $value) {
                if (!empty($value))
                    $isEmpty = false;
            }
            if (!$isEmpty) {
                $contactInfo = new ContactInfo();
                $this->contactInfoService->create($contactInfo);
                $model->contact_info_id = $contactInfo->id;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->locationRepository->update($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }

    }

    public function show($id): Location
    {
        return $this->locationRepository->getById($id);
    }

}
