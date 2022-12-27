<?php

namespace api\khalsa\services;

use api\khalsa\repositories\ContactInfoRepository;
use yii\db\StaleObjectException;

class ContactInfoService implements \api\khalsa\interfaces\ServiceInterface
{

    private $contactInfoRepository;

    public function __construct(ContactInfoRepository $repository)
    {
        $this->contactInfoRepository = $repository;
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
        $contactInfo = $this->repository->getById($id);
        $this->contactInfoRepository->delete($contactInfo);
    }

    public function update()
    {
        // TODO: Implement update() method.
    }
}
