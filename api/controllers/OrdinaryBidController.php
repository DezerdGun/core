<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\OrdinaryBidService;
use api\templates\ordinary_bid\Large;
use api\templates\ordinary_bid\Medium;
use api\templates\ordinary_bid\Small;
use common\models\OrdinaryBid;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;

class OrdinaryBidController extends \api\controllers\BaseController
{
    public $service;
    public function __construct
    (
        $id,
        $module,
        $config = [],
        OrdinaryBidService $service
    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }
    /**
     * @OA\Get(
     *     path="/ordinary/bid",
     *     tags={"ordinary-bid"},
     *     operationId="getOrindaryBid",
     *     summary="getOrdinaryBid",
     *     @OA\Parameter(
     *         name="SearchOrdinaryBid[is_favorite]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="boolean"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             default=0
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page_size",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             default=10
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="success"
     *              ),
     *              @OA\Property (
     *                  property="data",
     *                  type="array",
     *                  @OA\Items (
     *                      @OA\Property(
     *                          property="id",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="broker_name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="pick_up",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="created_at",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="updated_at",
     *                          type="string"
     *                      ),
     *                      @OA\Property (
     *                          property="note_from_carrier",
     *                          type="string"
     *                      ),
     *                      @OA\Property (
     *                          property="is_favorite",
     *                          type="boolean"
     *                      ),
     *                      @OA\Property(
     *                          property="ordinary_info",
     *                          type="object",
     *                          @OA\Property(
     *                              property="origin_city",
     *                              type="string"
     *                          ),
     *                          @OA\Property(
     *                              property="origin_state_code",
     *                              type="string"
     *                          ),
     *                          @OA\Property(
     *                              property="destination_city",
     *                              type="string"
     *                          ),
     *                          @OA\Property(
     *                              property="destination_state_code",
     *                              type="string"
     *                          ),
     *                          @OA\Property(
     *                              property="size",
     *                              type="string"
     *                          ),
     *                          @OA\Property(
     *                              property="weight",
     *                              type="integer"
     *                          )
     *                      ),
     *                      @OA\Property (
     *                          property="additional_info",
     *                          type="object",
     *                          @OA\Property (
     *                              property="mobile_number",
     *                              type="string"
     *                          ),
     *                          @OA\Property (
     *                              property="email",
     *                              type="string"
     *                          ),
     *                          @OA\Property (
     *                              property="hazmat",
     *                              type="string"
     *                          ),
     *                          @OA\Property (
     *                              property="overweight",
     *                              type="string"
     *                          ),
     *                          @OA\Property (
     *                              property="reefer",
     *                              type="string"
     *                          ),
     *                          @OA\Property (
     *                              property="alcohol",
     *                              type="string"
     *                          ),
     *                          @OA\Property (
     *                              property="urgent",
     *                              type="string"
     *                          ),
     *                          @OA\Property (
     *                              property="note_from_broker",
     *                              type="string"
     *                          )
     *                      ),
     *                      @OA\Property (
     *                          property="bid_detail",
     *                          type="array",
     *                          @OA\Items(
     *                              @OA\Property (
     *                                  property="bid_detail_id",
     *                                  type="integer"
     *                              ),
     *                              @OA\Property (
     *                                  property="charge",
     *                                  type="object",
     *                                  @OA\Property (
     *                                      property="id",
     *                                      type="integer"
     *                                  ),
     *                                  @OA\Property (
     *                                      property="charge_name",
     *                                      type="string"
     *                                  )
     *                              ),
     *                              @OA\Property (
     *                                  property="measure",
     *                                  type="object",
     *                                  @OA\Property (
     *                                      property="id",
     *                                      type="integer"
     *                                  ),
     *                                  @OA\Property (
     *                                      property="measure_name",
     *                                      type="string"
     *                                  ),
     *                              ),
     *                              @OA\Property (
     *                                  property="price",
     *                                  type="string"
     *                              ),
     *                              @OA\Property (
     *                                  property="free_unit",
     *                                  type="integer"
     *                              )
     *                          )
     *                      )
     *                  )
     *              )
     *          )
     *     ),
     *     security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *     }
     * )
     * @throws HttpException
     */
    public function actionIndex($page = 0, $page_size = 10)
    {
        $query = $this->service->index();
        return $this->index($query, $page, $page_size, Large::class);
    }

    /**
     * @OA\Post(
     *     path="/ordinary/bid",
     *     tags={"ordinary-bid"},
     *     operationId="createOrdinaryBid",
     *     summary="createOrdinaryBid",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="OrdinaryBid[listing_ordinary_id]",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="OrdinaryBid[note]",
     *                      type="string"
     *                  ),
     *                  required={
     *                      "OrdinaryBid[listing_ordinary_id]",
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
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/OrdinaryBidSmall"
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
        $model = $this->service->create();
        $transaction->commit();
        return $this->success($model->getAsArray(Small::class));
    }
    /**
     * @OA\Patch (
     *     path="/ordinary/bid/{id}",
     *     tags={"ordinary-bid"},
     *     operationId="updateOrdinaryBid",
     *     summary="updateOrdinaryBid",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="OrdinaryBid[note]",
     *                      type="string"
     *                  ),
     *                  required={
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
     * @throws Exception
     * @throws HttpException
     */
    public function actionUpdate($id): array
    {
        $transaction = Yii::$app->db->beginTransaction();
        $this->service->update($id);
        $transaction->commit();
        return $this->success();
    }
    /**
     * @OA\Delete(
     *     path="/ordinary/bid/{id}",
     *     tags={"ordinary-bid"},
     *     operationId="deleteOrdinaryBid",
     *     summary="deleteOrdinaryBid",
     *     @OA\Parameter(
     *         name="id",
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
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionDelete($id): array
    {
        $this->service->delete($id);
        return $this->success();
    }
    /**
     * @OA\Get(
     *      path="/ordinary/bid/{listing_ordinary_id}",
     *      tags={"ordinary-bid"},
     *      operationId="getOrdinaryBidBroker",
     *      summary="getOrdinaryBidBroker",
     *      @OA\Parameter(
     *          name="listing_ordinary_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="SearchOrdinaryBid[carrier_name]",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *         )
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              default=0
     *         )
     *      ),
     *      @OA\Parameter(
     *          name="page_size",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              default=10
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successfull operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="success"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/OrdinaryBidMedium"
     *              )
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     * @throws HttpException
     */
    public function actionView($listing_ordinary_id, $page = 0, $page_size = 10): array
    {
        $query = $this->service->view($listing_ordinary_id);
        return $this->index($query, $page, $page_size, Medium::class);
    }
    /**
     * @OA\Patch (
     *     path="/ordinary/bid/favorite/{id}",
     *     tags={"ordinary-bid"},
     *     operationId="makeOrdinaryBidFavorite",
     *     summary="makeOrdinaryBidFavorite",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         request="OrdinaryBidFavorite",
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="OrdinaryBid[is_favorite]",
     *                      type="boolean"
     *                  ),
     *                  required={
     *                      "OrdinaryBid[is_favorite]"
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
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function actionFavorite($id): array
    {
        $this->service->favorite($id);
        return $this->success();
    }
    /**
     * @OA\Get(
     *     path="/ordinary/bid/count",
     *     tags={"ordinary-bid"},
     *     operationId="countOrdinaryBid",
     *     summary="countOrdinaryBid",
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
     *                 type="array",
     *                 @OA\Items(
     *                      @OA\Property(
     *                          property="is_favorite",
     *                          type="boolean"
     *                      ),
     *                      @OA\Property(
     *                          property="number",
     *                          type="integer"
     *                      ),
     *                 )
     *             ),
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionCount()
    {
        $data = OrdinaryBid::countBids();
        return $this->success($data);
    }
}
