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
     *     request="CarrierCreate",
     *     required=true,
     *      @OA\MediaType(
     *      mediaType="multipart/form-data",
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="Carrier[user_id]",
     *                  type="integer",
     *                  example="1",
     *               ),
     *              @OA\Property(
     *                  property="Company[mc_number]",
     *                  type="string",
     *                  example="64858",
     *               ),
     *              @OA\Property(
     *                  property="Company[dot]",
     *                  type="string",
     *                  example="875682",
     *               ),
     *              @OA\Property(
     *                  property="Company[is_dot]",
     *                  type="string",
     *                  enum={"true", "false"}
     *               ),
     *              @OA\Property(
     *                  property="Company[company_name]",
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
     *                  property="User[mobile_number]",
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
     *              required={
     *                  "Company[is_dot]",
     *                  "Carrier[user_id]",
     *                  "Company[company_name]",
     *                  "Address[street_address]",
     *                  "Address[city]",
     *                  "Address[state_code]",
     *                  "Address[zip]",
     *                  "User[mobile_number]",
     *                  "Carrier[w9_file]",
     *                  "Carrier[ic_file]"
     *              }
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
        $transaction = Yii::$app->db->beginTransaction();
        $this->carrierService->create();
        $transaction->commit();

        return $this->success();
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
        return $this->success();
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
