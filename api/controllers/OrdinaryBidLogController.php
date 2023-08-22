<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\OrdinaryBidLogService;
use api\templates\ordinary_bid_log\Large;
use Yii;
use yii\db\Exception;

class OrdinaryBidLogController extends \api\controllers\BaseController
{
    public $service;
    public function __construct(
        $id,
        $module,
        $config = [],
        OrdinaryBidLogService $service

    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/ordinary/bid/log/{ordinary_bid_id}",
     *     tags={"ordinary-bid-log"},
     *     operationId="getordinaryBidLog",
     *     summary="getOrdinaryBidLog",
     *     @OA\Parameter(
     *         name="ordinary_bid_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
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
     *             ),
     *             @OA\Property (
     *                  property="data",
     *                  type="array",
     *                  @OA\Items (
     *                      @OA\Property (
     *                          property="id",
     *                          type="integer"
     *                      ),
     *                      @OA\Property (
     *                          property="action_date",
     *                          type="string"
     *                      ),
     *                      @OA\Property (
     *                          property="detail",
     *                          type="object",
     *                          @OA\Property (
     *                              property="container_bid_detail",
     *                              type="array",
     *                              @OA\Items (
     *                                  @OA\Property (
     *                                      property="charge_name",
     *                                      type="string"
     *                                  ),
     *                                  @OA\Property (
     *                                      property="measure_name",
     *                                      type="string"
     *                                  ),
     *                                  @OA\Property (
     *                                      property="price",
     *                                      type="string"
     *                                  ),
     *                                  @OA\Property (
     *                                      property="free_unit",
     *                                      type="integer"
     *                                  )
     *                              )
     *                          ),
     *                          @OA\Property (
     *                              property="note_from_carrier",
     *                              type="string"
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     * @throws \Exception
     */
    public function actionIndex($id, $page = 0, $page_size = 10)
    {
        $query = $this->service->index($id);
        return $this->index($query, $page, $page_size, Large::class);
    }

    /**
     * @OA\Post(
     *     path="/ordinary/bid/log/{ordinary_bid_id}",
     *     tags={"ordinary-bid-log"},
     *     operationId="logOrdinaryBid",
     *     summary="logOrdinaryBid",
     *     @OA\Parameter(
     *         name="ordinary_bid_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
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
     * @throws HttpException|Exception
     */
    public function actionCreate($id): array
    {
        $transaction = Yii::$app->db->beginTransaction();
        $this->service->create($id);
        $transaction->commit();
        return $this->success();
    }
}
