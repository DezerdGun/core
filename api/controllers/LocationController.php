<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\LocationService;
use api\templates\location\Small;
use api\templates\location\Large;
use common\models\Location;
use common\models\search\SearchLocation;
use Yii;
use yii\db\StaleObjectException;


class LocationController extends BaseController
{

    private $locationService;

    public function __construct(
        $id,
        $module,
        $config = [],
        LocationService $locationService
    )
    {
        parent::__construct($id, $module, $config);
        $this->locationService = $locationService;
    }

    /**
     * @OA\Get(
     *     path="/location",
     *     tags={"location"},
     *     operationId="getLocations",
     *     summary="getLocations",
     *     @OA\Parameter(
     *         name="location_type",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"Port","Warehouse"}
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=false,
     *         example="success",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="street_address",
     *         in="query",
     *         required=false,
     *     example="success",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="city",
     *         in="query",
     *         required=false,
     *     example="success",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="state_code",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="zip",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
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
     *                 @OA\Items(ref="#/components/schemas/LocationLarge")
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
    public function actionIndex($page = 0, $page_size = 10): array
    {
        $searchLocation = new SearchLocation();
        $params = [
            'SearchLocation' => Yii::$app->request->queryParams
        ];
        if ($searchLocation->load($params) && $searchLocation->validate()) {
            $query = $searchLocation->search();
        } else {
            throw new HttpException(400, ['SearchLocation' => $searchLocation->getErrors()]);
        }

        return $this->index($query, $page, $page_size, \api\templates\location\Small::class);
    }

    /**
     * @OA\Post(
     *     path="/location",
     *     tags={"location"},
     *     operationId="createLocation",
     *     summary="createLocation",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="Location[name]",
     *                     type="string",
     *                     example="Tokio",
     *                     description="Tokio",
     *                 ),
     *                 @OA\Property(
     *                     property="Address[street_address]",
     *                     type="string",
     *                      example="Los Angeles",
     *                      description="Los Angeles",
     *                 ),
     *                 @OA\Property(
     *                     property="Address[city]",
     *                     type="string",
     *                      example="Vice city",
     *                      description="Vice city",
     *                 ),
     *                 @OA\Property(
     *                     property="Address[state_code]",
     *                     type="string",
     *                     example="AL",
     *                      description="AL",
     *                 ),
     *                 @OA\Property(
     *                     property="Address[zip]",
     *                     type="string",
     *                     example="100741",
     *                     description="100741",
     *                 ),
     *                 @OA\Property(
     *                     property="Location[location_type]",
     *                     type="string",
     *                     enum={"Port","Warehouse"}
     *                 ),
     *                  required={
     *                     "Location[location_type]",
     *                     "Location[name]",
     *                     "Address[street_address]",
     *                     "Address[city]",
     *                     "Address[state_code]",
     *                     "Address[zip]",
     *              }
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
     *                 ref="#/components/schemas/LocationSmall"
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
        $model = $this->locationService->create();
        $transaction->commit();

        return $this->success($model->getAsArray(Small::class));

    }

    /**
     * @OA\Patch (
     *     path="/location/{id}",
     *     tags={"location"},
     *     operationId="patchLocation",
     *     summary="patchLocation",
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
     *                 @OA\Property(
     *                     property="Location[location_type]",
     *                     type="string",
     *                     enum={"Port","Warehouse"}
     *                 ),
     *                  @OA\Property(
     *                      property="Location[name]",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="Address[street_address]",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="Address[city]",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="Address[state_code]",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="Address[zip]",
     *                      type="stirng",
     *                  ),
     *                  @OA\Property(
     *                      property="ContactInfo[main_phone_number]",
     *                      type="stirng",
     *                  ),
     *                  @OA\Property(
     *                      property="ContactInfo[additional_phone_number]",
     *                      type="stirng",
     *                  ),
     *                  @OA\Property(
     *                      property="ContactInfo[main_email]",
     *                      type="stirng",
     *                  ),
     *                  @OA\Property(
     *                      property="ContactInfo[additional_email]",
     *                      type="stirng",
     *                  ),
     *                  required={
     *                  "Location[location_type]",
     *                  "Location[name]",
     *                  "Address[street_address]",
     *                  "Address[city]",
     *                  "Address[state_code]",
     *                  "Address[zip]",
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
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/LocationSmall"
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
        $transaction = Yii::$app->db->beginTransaction();
        $this->locationService->update($id);
        $transaction->commit();
        return $this->success();
    }

    /**
     * @OA\Delete(
     *     path="/location/{id}",
     *     tags={"location"},
     *     operationId="deleteLocation",
     *     summary="deleteLocation",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true
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
     *         {"ClientCredentials":{}}
     *     }
     * )
     * @throws StaleObjectException
     */


    public function actionDelete($id): array
    {
        $this->locationService->delete($id);
        return $this->success();
    }

    /**
     * @OA\Get(
     *     path="/location/{id}",
     *     tags={"location"},
     *     operationId="getLocation",
     *     summary="getLocation",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true
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
     *                 ref="#/components/schemas/LocationLarge"
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
    public function actionShow($id): array
    {
        $model = $this->locationService->show($id);
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Get(
     *     path="/location/count",
     *     tags={"location"},
     *     operationId="countLocationTypes",
     *     summary="countLocationTypes",
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
     *                          property="location_type",
     *                          type="string"
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
    public function actionCount(): array
    {
       $count = Location::countTypes();
        return $this->success($count);
    }
}
