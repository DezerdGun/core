<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\AddressRepository;
use common\models\Address;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use \api\khalsa\interfaces\ServiceInterface;
use Yii;

class AddressService implements ServiceInterface
{
    private $addressRepository;

    public function __construct(AddressRepository $repository)
    {
        $this->addressRepository = $repository;
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function create(): Address
    {
        $model = new Address();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->addressRepository->create($model);
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
        $model = $this->addressRepository->getById($id);
        $this->addressRepository->delete($model);
    }

    /**
     * @throws StaleObjectException
     */
    public function update($id)
    {
       $model = $this->addressRepository->getById($id);

       if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           $this->addressRepository->update($model);
       } else {
           throw new HttpException(400, [$model->formName() => $model->getErrors()]);
       }

    }
}
