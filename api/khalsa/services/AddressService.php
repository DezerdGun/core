<?php

namespace api\khalsa\services;

use api\khalsa\repositories\AddressRepository;
use yii\db\StaleObjectException;
use \api\khalsa\interfaces\ServiceInterface;

class AddressService implements ServiceInterface
{
    private $addressRepository;

    public function __construct(AddressRepository $repository)
    {
        $this->addressRepository = $repository;
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
        $address = $this->addressRepository->getById($id);
        $this->addressRepository->delete($address);
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }
}
