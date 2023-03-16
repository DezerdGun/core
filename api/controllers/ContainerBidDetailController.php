<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\ContainerBidDetailService;

class ContainerBidDetailController extends \api\controllers\BaseController
{
    public $service;
    public function __construct(
        $id,
        $module,
        $config = [],
        ContainerBidDetailService $service
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
     *     path="/container/bid/detail",
     *     tags={"container-bid-detail"},
     *     operationId="createContainerBidDetail",
     *     summary="createContainerBidDetail",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              encoding={
     *                  "ContainerBidDetail[charge_id][]": {
     *                      "explode": true
     *                  },
     *                  "ContainerBidDetail[measure_id][]": {
     *                      "explode": true
     *                  },
     *                  "ContainerBidDetail[price][]": {
     *                      "explode": true
     *                  },
     *                  "ContainerBidDetail[free_unit][]": {
     *                      "explode": true
     *                  },
     *              },
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="ContainerBidDetail[container_bid_id]",
     *                      type="integer"
     *                  ),
     *                  @OA\Property (
     *                      property="ContainerBidDetail[charge_id][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer"
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="ContainerBidDetail[measure_id][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer"
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="ContainerBidDetail[price][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="number",
     *                          format="float"
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="ContainerBidDetail[free_unit][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer",
     *                      )
     *                  ),
     *                  required={
     *                      "ContainerBidDetail[charge_id][]",
     *                      "ContainerBidDetail[container_bid_id]",
     *                      "ContainerBidDetail[measure_id][]",
     *                      "ContainerBidDetail[price][]"
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
    public function actionCreate()
    {
        $this->service->create();
        return $this->success();
    }

    /**
     * @OA\Patch (
     *     path="/container/bid/detail/{id}",
     *     tags={"container-bid-detail"},
     *     operationId="updateContainerBidDetail",
     *     summary="updateContainerBidDetail",
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
     *                  "ContainerBidDetail[charge_id][]": {
     *                      "explode": true
     *                  },
     *                  "ContainerBidDetail[measure_id][]": {
     *                      "explode": true
     *                  },
     *                  "ContainerBidDetail[price][]": {
     *                      "explode": true
     *                  },
     *                  "ContainerBidDetail[free_unit][]": {
     *                      "explode": true
     *                  },
     *              },
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="ContainerBidDetail[charge_id][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer"
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="ContainerBidDetail[measure_id][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer"
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="ContainerBidDetail[price][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="number",
     *                          format="float"
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="ContainerBidDetail[free_unit][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer",
     *                      )
     *                  ),
     *                  required={
     *                      "ContainerBidDetail[charge_id][]",
     *                      "ContainerBidDetail[measure_id][]",
     *                      "ContainerBidDetail[price][]"
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
     */
    public function actionUpdate($id): array
    {
        $this->service->update($id);
        return $this->success();

    }
    /**
     * @OA\Delete(
     *     path="/container/bid/detail/{id}",
     *     tags={"container-bid-detail"},
     *     operationId="deleteContainerBidDetail",
     *     summary="deleteContainerBidDetail",
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
     */
    public function actionDelete($id): array
    {
        $this->service->delete($id);
        return $this->success();
    }
}
