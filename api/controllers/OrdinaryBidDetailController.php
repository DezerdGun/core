<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\OrdinaryBidDetailService;
use Yii;
use yii\db\Exception;


class OrdinaryBidDetailController extends \api\controllers\BaseController
{
    public $service;
    public function __construct
    (
        $id,
        $module,
        $config = [],
        OrdinaryBidDetailService $service
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * @OA\Post(
     *     path="/ordinary/bid/detail",
     *     tags={"ordinary-bid-detail"},
     *     operationId="createOrdinartuBidDetail",
     *     summary="createOrdinaryBidDetail",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              encoding={
     *                  "OrdinaryBidDetail[charge_id][]": {
     *                      "explode": true
     *                  },
     *                  "OrdinaryBidDetail[measure_id][]": {
     *                      "explode": true
     *                  },
     *                  "OrdinaryBidDetail[price][]": {
     *                      "explode": true
     *                  },
     *                  "OrdinaryBidDetail[free_unit][]": {
     *                      "explode": true
     *                  },
     *              },
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="OrdinaryBidDetail[ordinary_bid_id]",
     *                      type="integer"
     *                  ),
     *                  @OA\Property (
     *                      property="OrdinaryBidDetail[charge_id][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer"
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="OrdinaryBidDetail[measure_id][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer"
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="OrdinaryBidDetail[price][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="number",
     *                          format="float"
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="OrdinaryBidDetail[free_unit][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer",
     *                      )
     *                  ),
     *                  required={
     *                      "OrdinaryBidDetail[charge_id][]",
     *                      "OrdinaryBidDetail[ordinary_bid_id]",
     *                      "OrdinaryBidDetail[measure_id][]",
     *                      "OrdinaryBidDetail[price][]"
     *                  }
     *              )
     *         )
     *     ),
     *       @OA\Response(
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
        $this->service->create();
        return $this->success();
    }
    /**
     * @OA\Patch (
     *     path="/ordinary/bid/detail/{id}",
     *     tags={"ordinary-bid-detail"},
     *     operationId="updateOrdinaryBidDetail",
     *     summary="updateOrdinaryBidDetail",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                  type="integer",
     *             )
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              encoding={
     *                  "OrdinaryBidDetail[charge_id][]": {
     *                      "explode": true
     *                  },
     *                  "OrdinaryBidDetail[measure_id][]": {
     *                      "explode": true
     *                  },
     *                  "OrdinaryBidDetail[price][]": {
     *                      "explode": true
     *                  },
     *                  "OrdinaryBidDetail[free_unit][]": {
     *                      "explode": true
     *                  },
     *              },
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="OrdinaryBidDetail[charge_id][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer"
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="OrdinaryBidDetail[measure_id][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer"
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="OrdinaryBidDetail[price][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="number",
     *                          format="float"
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="OrdinaryBidDetail[free_unit][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer",
     *                      )
     *                  ),
     *                  required={
     *                      "OrdinaryBidDetail[charge_id][]",
     *                      "OrdinaryBidDetail[measure_id][]",
     *                      "OrdinaryBidDetail[price][]"
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
    public function actionUpdate($id)
    {
        $this->service->update($id);
        return $this->success();
    }

    /**
     * @OA\Delete(
     *     path="/ordinary/bid/detail/{id}",
     *     tags={"ordinary-bid-detail"},
     *     operationId="deleteOrdinaryBidDetail",
     *     summary="deleteOrdinaryBidDetail",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                  type="integer",
     *             )
     *         )
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
     * @throws Exception|HttpException
     */
    public function actionDelete($id): array
    {
        $transaction = Yii::$app->db->beginTransaction();
        $this->service->delete($id);
        $transaction->commit();
        return $this->success();
    }

}
