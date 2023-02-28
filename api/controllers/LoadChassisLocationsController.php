<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\LoadChassisLocationsService;
use api\khalsa\services\LoadContainerReturnService;
use api\templates\chassis_locations\Large;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

class LoadChassisLocationsController extends BaseController
{
    public $chassisLocation;

    public function __construct($id, $module, $config = [],
                                LoadChassisLocationsService $chassisLocation
    )
    {
        parent::__construct($id, $module, $config);
        $this->chassisLocation = $chassisLocation;

    }

    /**
     * @OA\Post(
     *     path="/load-chassis-locations",
     *     tags={"chassis-locations"},
     *     operationId="createChassisLocations",
     *     summary="createChassisLocations",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  @OA\Property(
     *                     property="load_id",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="chassis_pickup",
     *                     type="integer",
     *                     example="1",
     *                     description="chassis_pickup {fk} to Location {id}"
     *                 ),
     *                  @OA\Property(
     *                     property="chassis_termination",
     *                     type="integer",
     *                     example="1",
     *                     description="chassis_termination {fk} to Location {id}"
     *                 ),
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
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/ChassisLocationsLarge")
     *             ),
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     * @throws HttpException
     * @throws InvalidConfigException
     */

    public function actionCreate(): array
    {
        $model = $this->chassisLocation->create();
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Patch (
     *     path="/load-chassis-locations/{id}",
     *     tags={"chassis-locations"},
     *     operationId="updateChassisLocations",
     *     summary="updateChassisLocations",
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
     *                     property="chassis_pickup",
     *                     type="integer",
     *                     example="1",
     *                     description="chassis_pickup {fk} to Location {id}"
     *                 ),
     *                  @OA\Property(
     *                     property="chassis_termination",
     *                     type="integer",
     *                     example="1",
     *                     description="chassis_termination {fk} to Location {id}"
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
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/ChassisLocationsLarge")
     *             ),
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     */

    public function actionUpdate($id): array
    {
        try {
            $this->chassisLocation->update($id);
        } catch (HttpException $e) {
        } catch (InvalidConfigException $e) {
        } catch (StaleObjectException $e) {
        }
        return $this->success();
    }

    /**
     * @OA\Delete(
     *     path="/load-chassis-locations/{id}",
     *     tags={"chassis-locations"},
     *     operationId="deleteChassisLocations",
     *     summary="deleteChassisLocations",
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
     *              @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/ChassisLocationsLarge")
     *             ),
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     * @throws StaleObjectException
     */

    public function actionDelete($id): array
    {
        $this->chassisLocation->delete($id);
        return $this->success();
    }
}