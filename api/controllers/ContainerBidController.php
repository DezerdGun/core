<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\ContainerBidService;
use api\templates\container_bid\Large;
use api\templates\container_bid\Small;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;

class ContainerBidController extends BaseController
{
    public $containerBidService;

    public function __construct
    (
        $id,
        $module,
        $config = [],
        ContainerBidService $containerBidService
    )
    {
        parent::__construct($id, $module, $config);
        $this->containerBidService = $containerBidService;
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
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/ContainerBidLarge"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionIndex($page = 0, $page_size = 10)
    {
        $query = $this->containerBidService->index();
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
     */
    public function actionCreate()
    {
        $transaction = Yii::$app->db->beginTransaction();
        $model = $this->containerBidService->create();
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
        $this->containerBidService->update($id);
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
     */
    public function actionDelete($id): array
    {
        $this->containerBidService->delete($id);
        return $this->success();
    }

    public function actionView()
    {

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
        $this->containerBidService->favorite($id);
        return $this->success();
    }
}
