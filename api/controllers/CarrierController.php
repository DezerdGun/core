<?php

namespace api\controllers;

use api\components\HttpException;
use api\forms\company\CompanyCreateForm;
use api\khalsa\services\CarrierService;
use api\templates\carrier\Large;
use api\templates\carrier\Small;
use common\models\Carrier;
use Yii;
use yii\web\NotFoundHttpException;

class CarrierController extends BaseController
{
    private $carrierService;

    public function __construct(
        $id,
        $module,
        $config = [],
        CarrierService $carrierService
    )
    {
        parent::__construct($id, $module, $config);
        $this->carrierService = $carrierService;
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
     *
     * @OA\RequestBody(
     *     request="CarrierCreateForm",
     *     required=true,
     *      @OA\MediaType(
     *      mediaType="multipart/form-data",
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="CompanyCreateForm[user_id]",
     *                  type="integer",
     *                  example="1",
     *               ),
     *              @OA\Property(
     *                  property="CompanyCreateForm[mc_number]",
     *                  type="string",
     *                  example="64858",
     *               ),
     *              @OA\Property(
     *                  property="CompanyCreateForm[dot]",
     *                  type="string",
     *                  example="875682",
     *               ),
     *              @OA\Property(
     *                  property="CompanyCreateForm[is_dot]",
     *                  type="boolean",
     *                  default=true
     *               ),
     *              @OA\Property(
     *                  property="CompanyCreateForm[company_name]",
     *                  type="string",
     *                  example="Omega Global",
     *               ),
     *              @OA\Property(
     *                  property="Address[street_address]",
     *                  type="string",
     *                  example="319 Ridge Rd",
     *               ),
     *              @OA\Property(
     *                  property="Address[city]",
     *                  type="string",
     *                   example="South San Francisco",
     *               ),
     *              @OA\Property(
     *                  property="Address[state_code]",
     *                  type="string",
     *                  example="CA",
     *               ),
     *              @OA\Property(
     *                  property="Address[zip]",
     *                  type="string",
     *                  example="35210",
     *               ),
     *              @OA\Property(
     *                  property="CompanyCreateForm[business_phone]",
     *                  type="string",
     *                  example="+13026893120",
     *               ),
     *              @OA\Property(
     *                  property="Carrier[w9_file]",
     *                  type="string",
     *                  format="binary"
     *              ),
     *              @OA\Property(
     *                  property="Carrier[ic_file]",
     *                  type="string",
     *                  format="binary"
     *              ),
     *          )
     *     )
     * ),
     *         @OA\Response(
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
        $model = new CompanyCreateForm();
        $model->scenario = CompanyCreateForm::SCENARIO_CARRIER_CREATE;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            $carrier = $this->carrierService->create($model);
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
