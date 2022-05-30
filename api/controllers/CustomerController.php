<?php

namespace api\controllers;

use api\forms\customer\CustomerCreateForm;
use api\components\HttpException;
use api\templates\customer\Small;
use common\models\Customer;
use Yii;

class CustomerController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/customer",
     *     tags={"customer"},
     *     operationId="Customer",
     *     summary="createCustomer",
     *     requestBody={"$ref":"#/components/requestBodies/CustomerCreateForm"},
     *       @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/CustomerSmall"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionCreate()
    {
        $createForm = new CustomerCreateForm();
        $model = new Customer();
        if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            $model->user_id = $createForm->user_id;
            $this->saveModel($model);
        } else {
            throw new HttpException(400, [$createForm->formName() => $createForm->getErrors()]);
        }
        return $this->success($model->getAsArray(Small::class));
    }

}
