<?php

namespace api\controllers;

use api\khalsa\services\BrokerService;
use api\templates\broker\Large;
use Yii;

class BrokerController extends BaseController
{
    public $brokerService;
    public function __construct
    (
        $id,
        $module,
        $config = [],
        BrokerService $brokerService
    )
    {
        parent::__construct($id, $module, $config);
        $this->brokerService = $brokerService;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * @OA\Patch (
     *     path="/broker/my-account",
     *     tags={"broker"},
     *     operationId="updateBrokerMyAccount",
     *     summary="updateMyAccount",
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
     *                      property="User[email]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="User[mobile_number]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="Company[company_name]",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="Company[dot]",
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
     *                  required={
     *                      "User[name]",
     *                      "User[email]",
     *                      "User[mobile_number]",
     *                      "Company[company_name]",
     *                      "Company[dot]",
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
        $this->brokerService->update(\Yii::$app->user->id);
        $transaction->commit();
        return $this->success();
    }
    /**
     * @OA\Get(
     *     path="/broker/my-account",
     *     tags={"broker"},
     *     operationId="getBrokerMyAccount",
     *     summary="getBrokerMyAccount",
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
     *                 ref="#/components/schemas/BrokerLarge"
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
    public function actionShow(): array
    {
        $model = $this->brokerService->show(\Yii::$app->user->id);
        return $this->success($model->getAsArray(Large::class));
    }

}
