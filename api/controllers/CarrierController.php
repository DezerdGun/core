<?php

namespace api\controllers;

use api\components\HttpException;
use api\forms\user\UserCreateForm;
use api\khalsa\services\CarrierService;
use api\templates\carrier\Large;
use common\models\User;
use Yii;


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
     *     requestBody={"$ref":"#/components/requestBodies/UserCreateForm"},
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
     *                 ref="#/components/schemas/UserSmall"
     *             )
     *         )
     *     ),
     *     security={
     *     {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionCreate()
    {
        $model = new UserCreateForm();
        $user = new User();
        $user->role = $user::CARRIER;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->signup($user);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $this->success($user->getAsArray(\api\templates\user\Small::class));
    }
    /**
     * @OA\Post(
     *     path="/carrier/company",
     *     tags={"carrier"},
     *     operationId="createCarrierCompany",
     *     summary="createCarrierCompany",
     *
     * @OA\RequestBody(
     *     request="CarrierCompanyCreate",
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

    public function actionCreateCompany(): array
    {
        $transaction = Yii::$app->db->beginTransaction();
        $this->carrierService->createCompany();
        $transaction->commit();

        return $this->success();
    }

    /**
     * @OA\Get(
     *     path="/carrier/my-account",
     *     tags={"carrier"},
     *     operationId="getCarrierMyAccount",
     *     summary="getCarrierMyAccount",
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
     *     }
     * )
     */

    public function actionShow(): array
    {
        $model = $this->carrierService->show();
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Patch (
     *     path="/carrier/my-account",
     *     tags={"carrier"},
     *     operationId="updateCarrierMyAccount",
     *     summary="updateCarrierMyAccount",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="User[name]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="Company[mc_number]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="Company[dot]",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="Company[is_dot]",
     *                      type="string",
     *                      enum={"true", "false"}
     *                  ),
     *                  @OA\Property (
     *                      property="Company[company_name]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="User[email]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="User[mobile_number]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="Address[street_address]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="Address[city]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="Address[state_code]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="Address[zip]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="Carrier[scac]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="Carrier[instagram]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="Carrier[facebook]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="Carrier[linkedin]",
     *                      type="string"
     *                  ),
     *                  required={
     *                      "Company[is_dot]",
     *                      "User[name]",
     *                      "Company[company_name]",
     *                      "User[email]",
     *                      "User[mobile_number]",
     *                      "Address[street_address]",
     *                      "Address[city]",
     *                      "Address[state_code]",
     *                      "Address[zip]"
     *                  }
     *              )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successfull operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="success"
     *              )
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     */
    public function actionUpdate()
    {
        $transaction = Yii::$app->db->beginTransaction();
        $this->carrierService->update();
        $transaction->commit();
    }


}
