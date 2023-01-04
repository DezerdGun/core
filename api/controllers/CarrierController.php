<?php

namespace api\controllers;

use api\components\HttpException;
use api\forms\carrier\CarrierCreateForm;
use api\khalsa\services\AddressService;
use api\khalsa\services\CarrierService;
use api\khalsa\services\CompanyService;
use api\templates\carrier\Large;
use api\templates\carrier\Small;
use common\models\Carrier;
use Yii;
use yii\web\NotFoundHttpException;

class CarrierController extends BaseController
{
    private $addressService;
    private $carrierService;
    private $companyService;

    public function __construct(
        $id,
        $module,
        $config = [],
        AddressService $addressService,
        CarrierService $carrierService,
        CompanyService $companyService
    )
    {
        parent::__construct($id, $module, $config);
        $this->addressService = $addressService;
        $this->carrierService = $carrierService;
        $this->companyService = $companyService;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @OA\Post(
     *     path="/carrier",
     *     tags={"carrier"},
     *     operationId="createCarrier",
     *     summary="createCarrier",
     *     requestBody={
     *          "$ref":"#/components/requestBodies/CarrierCreateForm",
     *     },
     *     @OA\Response(
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
     *                 ref="#/components/schemas/CarrierSmall"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionCreate(): array
    {
        $model = new CarrierCreateForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            $address = $this->addressService->create();
            $company = $this->companyService->create($address, $model);
            $carrier = $this->carrierService->create($company, $model);
            $transaction->commit();
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $this->success($carrier->getAsArray(Small::class));
    }

    /**
     * @OA\Get(
     *     path="/carrier/{id}",
     *     tags={"carrier"},
     *     operationId="getCarrier",
     *     summary="getCarrier",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
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
     *                 ref="#/components/schemas/CarrierLarge"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *
     *     }
     * )
     */

    public function actionShow($id)
    {
        $model = $this->findModel($id);
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Delete(
     *     path="/carrier/{id}",
     *     tags={"carrier"},
     *     operationId="deleteCarrier",
     *     summary="deleteCarrier",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->delete();
        return $this->success($model->getAsArray(Large::class));
    }

    private function findModel($id)
    {
        $condition = ['id' => $id];
        $model = Carrier::findOne($condition);
        if (!$model){
            throw new NotFoundHttpException();
        }
        return $model;
    }
}
