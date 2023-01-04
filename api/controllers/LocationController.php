<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\AddressService;
use api\khalsa\services\LocationService;
use common\models\Address;
use common\models\ContactInfo;
use common\models\Location;
use common\models\search\SearchLocation;
use PHPUnit\Exception;
use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

class LocationController extends BaseController
{

    private $locationService;
    private $addressService;
    private $contactInfoService;

    public function __construct(
        $id,
        $module,
        $config = [],
        LocationService $locationService,
        AddressService $addressService,
        ContactInfo $contactInfoService
    )
    {
        parent::__construct($id, $module, $config);
        $this->locationService = $locationService;
        $this->addressService = $addressService;
        $this->contactInfoService = $contactInfoService;
    }

    /**
     * @OA\Get(
     *     path="/location",
     *     tags={"location"},
     *     operationId="getLocation",
     *     summary="getLocation",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="street_address",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="city",
     *         in="query",
     *         required=false,
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
     *         name="is_port",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"yes","no"},
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="is_warehouse",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"yes","no"},
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
    public function actionIndex($page = 0, $pageSize = 25)
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


        return $this->index($query, $page, $pageSize, \api\templates\location\Large::class);
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
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Address[street_address]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Address[city]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Address[state_code]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Address[zip]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Location[location_type]",
     *                     type="string",
     *                     enum={"port","warehouse"}
     *                 ),
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
    public function actionCreate()
    {
        $model = new Address();
        $transaction = Yii::$app->db->beginTransaction();
        if ($model->load($this->getAllowedPost()) && $model->save()) {
            $location = new Location();
            $location->address_id = $model->id;
            if ($location->load(\Yii::$app->request->post()) && $location->validate()) {
                $location->save();
            } else {
                throw new HttpException(400, [$location->formName() => $location->getErrors()]);
            }
            $transaction->commit();
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $this->success();

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
     *                 @OA\Property(
     *                     property="Location[location_type]",
     *                     type="string",
     *                     enum={"port","warehouse"}
     *                 ),
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
     */

    public function actionUpdate($id)
    {
        try {
            $this->locationService->update($id);
        } catch (Exception $exception) {

        }


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
     */


    public function actionDelete($id): array
    {
        try {
            $this->locationService->delete($id);
        } catch (\Exception $exception) {

        }

        return $this->success();
    }

}
