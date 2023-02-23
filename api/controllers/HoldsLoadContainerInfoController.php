<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\HoldsLoadContainerInfoService;
use api\templates\holds_container_info\Large;
use common\models\Holds;
use common\models\Holds_history;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;

class HoldsLoadContainerInfoController extends BaseController
{
    public $holdsLoadContainerInfo;


    public function __construct($id, $module, $config = [],
                                HoldsLoadContainerInfoService $holdsLoadContainerInfo

    )
    {
        parent::__construct($id, $module, $config);
        $this->holdsLoadContainerInfo = $holdsLoadContainerInfo;

    }

    /**
     * @OA\Post(
     *     path="/holds-load-container-info",
     *     tags={"holds-load-info"},
     *     operationId="createHoldsLoadsInfo",
     *     summary="createHoldsLoadsInfo",
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
     *                     property="freight_hold",
     *                     enum={"yes","no"},
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="customer_hold",
     *                     enum={"yes","no"},
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="carrier_hold",
     *                     enum={"yes","no"},
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="broker_hold",
     *                     enum={"yes","no"},
     *                     type="string"
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
     *                 @OA\Items(ref="#/components/schemas/HoldsLoadContainerInfoLarge")
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
        $model = $this->holdsLoadContainerInfo->create();
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Patch (
     *     path="/holds-load-container-info/{id}",
     *     tags={"holds-load-info"},
     *     operationId="updateHoldsLoadsInfo",
     *     summary="updateHoldsLoadsInfo",
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
     *                  property="freight_hold",
     *                  enum={"yes","no"},
     *                  type="string"
     *               ),
     *              @OA\Property(
     *                  property="customer_hold",
     *                  enum={"yes","no"},
     *                  type="string"
     *               ),
     *              @OA\Property(
     *                  property="carrier_hold",
     *                  enum={"yes","no"},
     *                  type="string"
     *               ),
     *              @OA\Property(
     *                  property="broker_hold",
     *                  enum={"yes","no"},
     *                  type="string"
     *               ),
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

    public function actionUpdate($id): array
    {
        try {
            $this->holdsLoadContainerInfo->update($id);
        } catch (HttpException $e) {
        } catch (InvalidConfigException $e) {
        }
        return $this->success();
    }

    /**
     * @OA\Get(
     *     path="/holds-load-container-info",
     *     tags={"holds-load-info"},
     *     operationId="getHoldsLoadsInfo",
     *     summary="getHoldsLoadsInfo",
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
     *                     @OA\Property(
     *                         property="id",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="date"
     *                     ),
     *                      @OA\Property(
     *                         property="note_from_customer_and_broker",
     *                         type="text"
     *                     ),
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
    public function actionIndex(): array
    {
        $equipment = Holds_history::find()
            ->select('id,updated_at,note_from_customer_and_broker')
            ->all();
        return $this->success($equipment);
    }

}