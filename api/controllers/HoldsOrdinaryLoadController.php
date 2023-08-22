<?php

namespace api\controllers;

use api\khalsa\repositories\HoldsOrdinaryLoadRepository;
use api\khalsa\services\HoldsOrdinaryLoadService;
use common\models\OrdinaryHolds;
use common\models\OrdinaryHoldsHistory;
use OpenApi\Annotations as OA;
use yii\web\NotFoundHttpException;

class HoldsOrdinaryLoadController extends BaseController
{
    public $holdsOrdinaryLoadRepository;
    public $holdsOrdinaryLoadService;


    public function __construct($id, $module, $config = [],
                                HoldsOrdinaryLoadService $holdsOrdinaryLoadService,
                                HoldsOrdinaryLoadRepository $holdsOrdinaryLoadRepository

    )
    {
        parent::__construct($id, $module, $config);
        $this->holdsOrdinaryLoadRepository = $holdsOrdinaryLoadRepository;
        $this->holdsOrdinaryLoadService = $holdsOrdinaryLoadService;

    }

    /**
     * @OA\Get(
     *     path="/holds-ordinary-load/{id}",
     *     tags={"holds-ordinary-load"},
     *     operationId="getHoldsOrdinaryLoadsHistoryId",
     *     summary="getHoldsOrdinaryLoadsHistoryId",
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
     * @throws NotFoundHttpException
     */
    public function actionShow($id): array
    {
        $model = $this->list($id);
        return $this->success($model);
    }

    /**
     * @throws NotFoundHttpException
     */
    private function list($id): OrdinaryHolds
    {
        $con = ['load_id' => $id];
        $model = OrdinaryHolds::findOne($con);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $model;
    }

    /**
     * @OA\Patch (
     *     path="/holds-ordinary-load/{id}",
     *     tags={"holds-ordinary-load"},
     *     operationId="updateHoldsOrdinaryLoadsHistory",
     *     summary="updateHoldsOrdinaryLoadsHistory",
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
        $this->holdsOrdinaryLoadService->update($id);
        return $this->success();
    }

    /**
     * @OA\Get(
     *     path="/holds-ordinary-load",
     *     tags={"holds-ordinary-load"},
     *     operationId="getHoldsOrdinaryLoadsHistory",
     *     summary="getHoldsOrdinaryLoadsHistory",
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
        $equipment = OrdinaryHoldsHistory::find()
            ->select('id,load_id,updated_at,created_at,note_from_customer_and_broker')
            ->all();
        return $this->success($equipment);
    }
}