<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\HoldsLoadContainerInfoService;
use api\templates\holds_container_info\Large;
use common\models\Holds;
use common\models\Holds_history;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;
use yii\web\NotFoundHttpException;

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
     *                  example="yes",
     *                  type="string"
     *               ),
     *              @OA\Property(
     *                  property="customer_hold",
     *                  enum={"yes","no"},
     *                  type="string",
     *                  example="yes",
     *               ),
     *              @OA\Property(
     *                  property="carrier_hold",
     *                  enum={"yes","no"},
     *                  type="string",
     *                   example="yes",
     *               ),
     *              @OA\Property(
     *                  property="broker_hold",
     *                  enum={"yes","no"},
     *                  type="string",
     *                  example="yes",
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
        $this->holdsLoadContainerInfo->update($id);
        return $this->success();
    }

    /**
     * @OA\Get(
     *     path="/holds-load-container-infos/{id}",
     *     tags={"holds-load-info"},
     *     operationId="getHoldsLoadsInfoId",
     *     summary="getHoldsLoadsInfoId",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
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
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer"
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
    public function actionShow($id): array
    {
        $model = $this->list($id);
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @throws NotFoundHttpException
     */
    private function list($id)
    {
        $con = ['load_id' => $id];
        $model = Holds::findOne($con);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $model;
    }

    /**
     * @OA\Get(
     *     path="/holds-load-container-info/{id}",
     *     tags={"holds-load-info"},
     *     operationId="getHoldsHistoryLoadsInfoId",
     *     summary="getHoldsHistoryLoadsInfoId",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
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
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer"
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
    public function actionHistory($id): array
    {
        $model = $this->lists($id);
        return $this->success($model->getAsArray(\api\templates\hold_history\Large::class));
    }

    /**
     * @throws NotFoundHttpException
     */
    private function lists($id)
    {
        $con = ['load_id' => $id];
        $model = Holds_history::findOne($con);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $model;
    }

    /**
     * @OA\Get(
     *     path="/holds-load-container-info",
     *     tags={"holds-load-info"},
     *     operationId="getHoldsLoadsHistory",
     *     summary="getHoldsLoadsHistory",
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
     *                    @OA\Property(
     *                         property="load_id",
     *                         type="integer"
     *                     ),
     *                    @OA\Property(
     *                         property="updated_at",
     *                         type="date"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at ",
     *                         type="date"
     *                     ),
     *                     @OA\Property(
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
            ->select('id,load_id,updated_at,created_at,note_from_customer_and_broker')
            ->all();
        return $this->success($equipment);
    }
}