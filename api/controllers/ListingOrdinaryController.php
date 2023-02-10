<?php

namespace api\controllers;
use api\components\HttpException;
use api\khalsa\services\listing\ordinary\OrdinaryAdditionalInfo;
use api\khalsa\services\listing\ordinary\OrdinaryInfoService;
use api\khalsa\services\listing\ordinary\OrdinaryService;
use api\templates\listing_ordinary\Small;
use api\templates\listing_ordinary\Large;
use common\models\ListingOrdinary;
use common\models\search\SearchListingOrdinary;

class ListingOrdinaryController extends BaseController
{
    public $ordinaryService;
    public $ordinaryInfoService;
    public $ordinaryAdditionalInfo;

    public function __construct(
        $id,
        $module,
        $config = [],
        OrdinaryService $ordinaryService,
        OrdinaryInfoService $ordinaryInfoService,
        OrdinaryAdditionalInfo $ordinaryAdditionalInfo
    )
    {
        parent::__construct($id, $module, $config);
        $this->ordinaryService = $ordinaryService;
        $this->ordinaryInfoService = $ordinaryInfoService;
        $this->ordinaryAdditionalInfo = $ordinaryAdditionalInfo;
    }
    /**
     * @OA\Get(
     *     path="/listing/ordinary",
     *     tags={"listing-ordinary"},
     *     operationId="getListingOrdinaries",
     *     summary="getListingOrdinaries",
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[status][]",
     *         in="query",
     *         required=false,
     *         description="active, archived, hidden",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                  type="string"
     *             ),
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[origin_id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[destination_id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[size]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *              enum={"48x40","42x42","48x48"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[equipment_code][]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="array",
     *                 @OA\Items(
     *                     type="string"
     *                 ),
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[pick_up_from]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="date",
     *              pattern="^([0-9]{4})-(?:[0-9]{2})-([0-9]{2})$"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[pick_up_to]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="date",
     *              pattern="^[0-9]{4}-[0-9]{2}-[0-9]{2}$"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[quantity]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[max_weight]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[origin_state_code][]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="array",
     *                 @OA\Items(
     *                     type="string"
     *                 ),
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[destination_state_code][]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="array",
     *                 @OA\Items(
     *                     type="string"
     *                 ),
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[hazmat]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *              enum={"yes"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[overweight]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *              enum={"yes"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[reefer]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *              enum={"yes"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[alcohol]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *              enum={"yes"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingOrdinary[urgent]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *              enum={"yes"}
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
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/ListingOrdinaryLarge")
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 ref="#/components/schemas/Pagination"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionIndex($page = 0, $page_size = 10)
    {
        $query = $this->ordinaryService->index();

        return $this->index($query, $page, $page_size, Large::class);
    }
    /**
     * @OA\Post(
     *     path="/listing/ordinary",
     *     tags={"listing-ordinary"},
     *     operationId="createListingOrdinary",
     *     summary="createListingOrdinary",
     *
     * @OA\RequestBody(
     *     request="OrdinaryListing",
     *     required=true,
     *      @OA\MediaType(
     *      mediaType="multipart/form-data",
     *         encoding={
     *             "ListingOrdinaryForm[equipment_code][]": {
     *                 "explode": true
     *             }
     *         },
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="ListingOrdinaryForm[origin_id]",
     *                  type="integer",
     *               ),
     *              @OA\Property(
     *                  property="ListingOrdinaryForm[destination_id]",
     *                  type="integer",
     *               ),
     *              @OA\Property (
     *              property="ListingOrdinaryForm[equipment_code][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="string"
     *                      )
     *                  ),
     *              @OA\Property(
     *                  property="ListingOrdinaryForm[pick_up]",
     *                  type="date",
     *                  pattern="^([0-9]{4})-(?:[0-9]{2})-([0-9]{2})$",
     *                  example="2023-10-30",
     *               ),
     *              required={
     *                  "ListingOrdinaryForm[origin_id]",
     *                  "ListingOrdinaryForm[destination_id]",
     *                  "ListingOrdinaryForm[pick_up]",
     *                  "ListingOrdinaryForm[equipment_code][]"
     *              }
     *          )
     *     )
     * ),
     *
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
     *                 ref="#/components/schemas/ListingOrdinarySmall"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     * @throws HttpException
     */
    public function actionCreate()
    {
        $model = $this->ordinaryService->create();
        return $this->success($model->getAsArray(Small::class));
    }

    /**
     * @OA\Post(
     *     path="/listing/ordinary-info",
     *     tags={"listing-ordinary"},
     *     operationId="createListingOrdinaryInfo",
     *     summary="createListingOrdinaryInfo",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="listing_ordinary_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="quantity",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="size",
     *                     type="string",
     *                     enum={"48x40","42x42","48x48"}
     *                 ),
     *                 @OA\Property(
     *                     property="weight",
     *                     type="integer"
     *                 ),
     *                  required={
     *                     "listing_ordinary_id",
     *                     "quantity",
     *                     "size",
     *                     "weight"
     *                  }
     *             )
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
     * @throws HttpException
     */
    public function actionOrdinaryInfo(): array
    {
        $this->ordinaryInfoService->create();
        return $this->success();
    }

    /**
     * @OA\Post(
     *     path="/listing/ordinary/additional-info",
     *     tags={"listing-ordinary"},
     *     operationId="createOrdinaryAdditionalInfo",
     *     summary="createOrdinaryAdditionalInfo",
     *      @OA\RequestBody(
     *          request="ListingOrdinaryAdditionalInfo",
     *          required=true,
     *          @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="listing_ordinary_id",
     *                  type="integer",
     *              ),
     *              @OA\Property(
     *                  property="hazmat",
     *                  type="string",
     *                  enum={"no","yes"}
     *              ),
     *              @OA\Property(
     *                  property="hazmat_description",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="overweight",
     *                  type="string",
     *                  enum={"no","yes"}
     *              ),
     *              @OA\Property(
     *                  property="overweight_description",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="reefer",
     *                  type="string",
     *                  enum={"no","yes"}
     *              ),
     *              @OA\Property(
     *                  property="reefer_description",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="alcohol",
     *                  type="string",
     *                  enum={"no","yes"}
     *              ),
     *              @OA\Property(
     *                  property="alcohol_description",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="urgent",
     *                  type="string",
     *                  enum={"no","yes"}
     *              ),
     *              @OA\Property(
     *                  property="urgent_description",
     *                  type="string",
     *              ),
     *              @OA\Property(
     *                  property="note",
     *                  type="string",
     *              ),
     *              required={
     *                  "listing_ordinary_id",
     *                  "hazmat",
     *                  "overweight",
     *                  "reefer",
     *                  "alcohol",
     *                  "urgent",
     *              }
     *          )
     *      )
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
     *     {"ClientCredentials":{}}
     *     }
     * )
     * @throws HttpException
     */
    public function actionAdditionalInfo(): array
    {
        $this->ordinaryAdditionalInfo->create();
        return $this->success();
    }

    /**
     * @OA\Patch (
     *     path="/listing/ordinary/status",
     *     tags={"listing-ordinary"},
     *     operationId="changeListingOrdinaryStatus",
     *     summary="changeListingOrdinaryStatus",
     *     @OA\RequestBody(
     *          request="UpdateStatusForm",
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *         encoding={
     *             "UpdateStatusForm[id][]": {
     *                 "explode": true
     *             }
     *         },
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="UpdateStatusForm[id][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="UpdateStatusForm[status]",
     *                      type="string",
     *                      enum={"active","hidden", "archived"}
     *                  ),
     *                  required={
     *                      "UpdateStatusForm[status]",
     *                      "UpdateStatusForm[id][]"
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
    public function actionUpdateStatus(): array
    {
        $this->ordinaryService->updateStatus();
        return $this->success();
    }
    /**
     * @OA\Get(
     *     path="/listing/ordinary/count",
     *     tags={"listing-ordinary"},
     *     operationId="countListingOrdinary",
     *     summary="countListingOrdinary",
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
     *                          property="status",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="number",
     *                          type="integer"
     *                      ),
     *                 )
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionCount(): array
    {
        $data = ListingOrdinary::count();
        return $this->success($data);
    }
    /**
     * @OA\Patch (
     *     path="/listing/ordinary/reassign/{id}",
     *     tags={"listing-ordinary"},
     *     operationId="reassignListingOrdinaryUser",
     *     summary="reassignListingOrdinaryUser",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *          type="integer"
     *          )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *              @OA\Property(
     *                  property="user_id",
     *                  type="integer"
     *               ),
     *              required={
     *                  "user_id"
     *              }
     *            )
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
     *              ),
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     */
    public function actionReassign($id): array
    {
        $this->ordinaryService->update($id);
        return $this->success();
    }
}
