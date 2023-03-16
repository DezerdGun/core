<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\LoadContainerReturnService;
use api\templates\container_return\Large;
use common\models\Container_return;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

class LoadContainerReturnController extends BaseController
{
    public $containerReturn;

    public function __construct($id, $module, $config = [],
                                LoadContainerReturnService $containerReturn
    )
    {
        parent::__construct($id, $module, $config);
        $this->containerReturn = $containerReturn;

    }

    /**
     * @OA\Post(
     *     path="/load-container-return",
     *     tags={"container-return"},
     *     operationId="createContainerReturn",
     *     summary="createContainerReturn",
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
     *                     property="container_return",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="return_from",
     *                     type="date",
     *                     format="date-time",
     *                     pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *                     example="12-12-2021 21:39:00",
     *                     description="12-12-2021 21:39:00"
     *              ),
     *                 @OA\Property(
     *                     property="return_to",
     *                     type="date",
     *                     format="date-time",
     *                     pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *                     example="12-12-2021 21:39:00",
     *                     description="12-12-2021 06:39:00"
     *              ),
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
     *                 @OA\Items(ref="#/components/schemas/ContainerReturnLarge")
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
        $model = $this->containerReturn->create();
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Patch (
     *     path="/load-container-return/{load_id}",
     *     tags={"container-return"},
     *     operationId="updateContainerReturn",
     *     summary="updateContainerReturn",
     *     @OA\Parameter(
     *         in="path",
     *         name="load_id",
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
     *                     property="container_return",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="return_from",
     *                     type="date",
     *                     format="date-time",
     *                     pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *                     example="12-12-2021 21:39:00",
     *                     description="12-12-2021 21:39:00"
     *              ),
     *                 @OA\Property(
     *                     property="return_to",
     *                     type="date",
     *                     format="date-time",
     *                     pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *                     example="12-12-2021 21:39:00",
     *                     description="12-12-2021 06:39:00"
     *              ),
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

    public function actionUpdate($load_id): array
    {
        $this->containerReturn->update($load_id);
        return $this->success();
    }

    /**
     * @OA\Delete(
     *     path="/load-container-return/{load_id}",
     *     tags={"container-return"},
     *     operationId="deleteContainerReturn",
     *     summary="deleteContainerReturn",
     *     @OA\Parameter(
     *         name="load_id",
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
     *      {"ClientCredentials":{}}
     *     }
     * )
     * @throws StaleObjectException
     */

    public function actionDelete($load_id): array
    {
        $this->containerReturn->delete($load_id);
        return $this->success();
    }

    /**
     * @OA\Get(
     *     path="/load-container-return/{load_id}",
     *     tags={"container-return"},
     *     operationId="getContainerReturnID",
     *     summary="getContainerReturnID",
     *         @OA\Parameter(
     *         name="load_id",
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
     *                     @OA\Property(
     *                         property="load_id",
     *                         type="date"
     *                     ),
     *                     @OA\Property(
     *                         property="container_return",
     *                         type="date"
     *                     ),
     *                     @OA\Property(
     *                         property="return_from",
     *                         type="date"
     *                     ),
     *                      @OA\Property(
     *                         property="return_to",
     *                         type="date"
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

    public function actionShow($load_id): array
    {
        $model = $this->list($load_id);
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @throws NotFoundHttpException
     */
    private function list($load_id): Container_return
    {
        $con = ['load_id' => $load_id];
        $model = container_return::findOne($con);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $model;
    }
}