<?php

namespace api\controllers;


use api\components\HttpException;
use api\templates\address\Small;
use api\templates\carrier\Large;
use common\models\Address;
use common\models\Company;

class CompanyController extends BaseController
{
    public function actionCreate()
    {

        $model = new Address();
        if ($model->load($this->getAllowedPost()) && $model->validate()) {
            $model->save();
            if ($model->save()) {
                $detail = new Company();
                $detail->address_id = $model->id;
                if ($detail->load($this->getAllowedPost()) && $detail->validate()) {
                    $this->saveModel($detail);
                } else {
                    throw new HttpException(400, [$detail->formName() => $detail->getErrors()]);
                }
                return $this->success([
                    $model->getAsArray(Small::class)
                ]);

            }
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }

}
