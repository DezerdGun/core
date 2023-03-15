<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\ContainerBidLogService;
use api\khalsa\services\ContainerBidService;
use api\templates\container_bid\Large;
use api\templates\container_bid\Small;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;

class ContainerBidController extends BaseController
{
    public $service;

    public function __construct
    (
        $id,
        $module,
        $config = [],
        ContainerBidService $service

    )
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/container/bid",
     *     tags={"container-bid"},
     *     operationId="getContainerBid",
     *     summary="getContainerBid",
     *     @OA\Parameter(
     *         name="SearchContainerBid[is_favorite]",
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
     *                          property="vessel_eta",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="quantity",
     *                          type="integer"
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
     *                          property="container_info",
     *                          type="object",
     *                          @OA\Property(
     *                              property="port_city",
     *                              type="string"
     *                          ),
     *                          @OA\Property(
     *                              property="port_state_code",
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
     *                              property="container_code",
     *                              type="string"
     *                          ),
     *                          @OA\Property(
     *                              property="size",
     *                              type="integer"
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
    public function actionIndex($page = 0, $page_size = 10): array
    {
        $query = $this->service->index();
        return $this->index($query, $page, $page_size, Large::class);
    }

    /**
     * @OA\Post(
     *     path="/container/bid",
     *     tags={"container-bid"},
     *     operationId="createContainerBid",
     *     summary="createContainerBid",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="ContainerBid[quantity]",
     *                      type="integer",
     *                  ),
     *                  @OA\Property(
     *                      property="ContainerBid[listing_container_id]",
     *                      type="integer"
     *                  ),
     *                  @OA\Property(
     *                      property="ContainerBid[note]",
     *                      type="string"
     *                  ),
     *                  required={
     *                      "ContainerBid[quantity]",
     *                      "ContainerBid[listing_container_id]",
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
     *                 ref="#/components/schemas/ContainerBidSmall"
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
    public function actionCreate(): array
    {
        $transaction = Yii::$app->db->beginTransaction();
        $model = $this->service->create();
        $transaction->commit();
        return $this->success($model->getAsArray(Small::class));
    }

    /**
     * @OA\Patch (
     *     path="/container/bid/{id}",
     *     tags={"container-bid"},
     *     operationId="updateContainerBid",
     *     summary="updateContainerBid",
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
     *                      property="ContainerBid[quantity]",
     *                      type="integer",
     *                  ),
     *                  @OA\Property(
     *                      property="ContainerBid[note]",
     *                      type="string"
     *                  ),
     *                  required={
     *                      "ContainerBid[quantity]"
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
     *     path="/container/bid/{id}",
     *     tags={"container-bid"},
     *     operationId="deleteContainerBid",
     *     summary="deleteContainerBid",
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
     * @throws HttpException
     */
    public function actionDelete($id): array
    {
        $this->service->delete($id);
        return $this->success();
    }

    /**
     * @OA\Patch (
     *     path="/container/bid/favorite/{id}",
     *     tags={"container-bid"},
     *     operationId="makeContainerBidFavorite",
     *     summary="makeContainerBidFavorite",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         request="ContainerBidFavorite",
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="ContainerBid[is_favorite]",
     *                      type="boolean"
     *                  ),
     *                  required={
     *                      "ContainerBid[is_favorite]"
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

}
