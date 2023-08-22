<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\listing\AdditionalInfoService;
use api\khalsa\services\listing\ContainerInfoService;
use api\khalsa\services\listing\ContainerService;
use api\templates\listing_container\Large;
use common\models\ListingContainer;


class ListingContainerController extends BaseController
{
    public $containerService;
    public $additionalInfoService;
    public $containerInfoService;

    public function __construct
    (
        $id,
        $module,
        $config = [],
        ContainerService $containerService,
        AdditionalInfoService $additionalInfoService,
        ContainerInfoService $containerInfoService
    )
    {
        parent::__construct($id, $module, $config);
        $this->containerService = $containerService;
        $this->additionalInfoService = $additionalInfoService;
        $this->containerInfoService = $containerInfoService;
    }
    /**
     * @OA\Get(
     *     path="/listing/container",
     *     tags={"listing-container"},
     *     operationId="getListingContainers",
     *     summary="getListingContainers",
     *     @OA\Parameter(
     *         name="SearchListingContainer[id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingContainer[status][]",
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
     *         name="SearchListingContainer[port_id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingContainer[destination_id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingContainer[size]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingContainer[container_code][]",
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
     *         name="SearchListingContainer[owner_id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingContainer[port_state_code][]",
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
     *         name="SearchListingContainer[destination_state_code][]",
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
     *         name="SearchListingContainer[vessel_eta_from]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="date",
     *              pattern="^([0-9]{4})-(?:[0-9]{2})-([0-9]{2})$"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingContainer[vessel_eta_to]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="date",
     *              pattern="^[0-9]{4}-[0-9]{2}-[0-9]{2}$"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingContainer[max_weight]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingContainer[hazmat]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *              enum={"yes"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingContainer[overweight]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *              enum={"yes"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingContainer[reefer]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *              enum={"yes"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingContainer[alcohol]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *              enum={"yes"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchListingContainer[urgent]",
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
     *                 @OA\Items(ref="#/components/schemas/ListingContainerLarge")
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
        $query = $this->containerService->index();
        return $this->index($query, $page, $page_size, Large::class);
    }

    /**
     * @OA\Post(
     *     path="/listing/container",
     *     tags={"listing-container"},
     *     operationId="createListingContainer",
     *     summary="createListingContainer",
     *
     * @OA\RequestBody(
     *     request="ContainerListing",
     *     required=true,
     *      @OA\MediaType(
     *      mediaType="multipart/form-data",
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="port_id",
     *                  type="integer",
     *               ),
     *              @OA\Property(
     *                  property="destination_id",
     *                  type="integer",
     *               ),
     *              @OA\Property(
     *                  property="vessel_eta",
     *                  type="date",
     *                  pattern="^([0-9]{4})-(?:[0-9]{2})-([0-9]{2})$",
     *                  example="2023-10-30",
     *               ),
     *              required={
     *                  "port_id",
     *                  "destination_id",
     *                  "vessel_eta"
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
     *                 ref="#/components/schemas/ListingContainerSmall"
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
    public function actionCreate(): array
    {
        $model = $this->containerService->create();

        return $this->success($model->getAsArray(\api\templates\listing_container\Small::class));
    }
    /**
     * @OA\Patch (
     *     path="/listing/container/reassign/{id}",
     *     tags={"listing-container"},
     *     operationId="reassignListingContainerUser",
     *     summary="reassignListingContainerUser",
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
        $this->containerService->update($id);
        return $this->success();
    }
    /**
     * @OA\Post(
     *     path="/listing/container/additional-info",
     *     tags={"listing-container"},
     *     operationId="createContainerAdditionalInfo",
     *     summary="createContainerAdditionalInfo",
     *      @OA\RequestBody(
     *          request="ListingContainerAdditionalInfo",
     *          required=true,
     *          @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              @OA\Property(
     *                  property="listing_container_id",
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
     *                  "listing_container_id",
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
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/ListingAdditionalInfoSmall"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionAdditionalInfo(): array
    {
        $model = $this->additionalInfoService->create();
        return $this->success($model->getAsArray(\api\templates\listing_additional_info\Small::class));
    }

    /**
     * @OA\Post(
     *     path="/listing/container-info",
     *     tags={"listing-container"},
     *     operationId="createListingContainerInfo",
     *     summary="createListingContainerInfo",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="listing_container_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="quantity",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="size",
     *                     type="integer",
     *                     enum={"53","45","40","20"}
     *                 ),
     *                 @OA\Property(
     *                     property="container_code",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="owner_id",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="weight",
     *                     type="integer"
     *                 ),
     *                  required={
     *                     "listing_container_id",
     *                     "quantity",
     *                     "size",
     *                     "container_code",
     *                     "owner_id",
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
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property (
     *                      property="id",
     *                      type="integer"
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
    public function actionContainerInfo(): array
    {
        $model = $this->containerInfoService->create();
        return $this->success($model->getAsArray(\api\templates\listing_container_info\Small::class));
    }

    /**
     * @OA\Get(
     *     path="/listing/container/count",
     *     tags={"listing-container"},
     *     operationId="countListingContainers",
     *     summary="countListingContainers",
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
        $data = ListingContainer::count();
        return $this->success($data);
    }
    /**
     * @OA\Patch (
     *     path="/listing/container/status",
     *     tags={"listing-container"},
     *     operationId="changeListingContainerStatus",
     *     summary="changeListingContainerStatus",
     *     @OA\RequestBody(
     *          request="ListingContainerForm",
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *         encoding={
     *             "ListingContainerForm[id][]": {
     *                 "explode": true
     *             }
     *         },
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="ListingContainerForm[id][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                      property="ListingContainerForm[status]",
     *                      type="string",
     *                      enum={"active","hidden", "archived"}
     *                  ),
     *                  required={
     *                      "ListingContainerForm[status]",
     *                      "ListingContainerForm[id][]"
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
        $this->containerService->updateStatus();
        return $this->success();
    }
}
