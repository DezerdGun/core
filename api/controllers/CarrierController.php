<?php

namespace api\controllers;

use api\templates\carrier\Large;
use common\models\Carrier;

class CarrierController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @OA\Post(
     *     path="/carrier",
     *     tags={"carrier"},
     *     operationId="createCarrier",
     *     summary="createCarrier",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="Carrier[user_id]",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="Carrier[mc]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Carrier[dot]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Carrier[ein]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Carrier[w9_file]",
     *                     type="string",
     *                     format="binary"
     *                 ),
     *                 @OA\Property(
     *                     property="Carrier[ic_file]",
     *                     type="string",
     *                     format="binary"
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
     *                 type="object",
     *                 ref="#/components/schemas/CarrierSmall"
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
        $model = new Carrier();
        $model->setScenario(Carrier::SCENARIO_INSERT);
        $model->load($this->getAllowedPost());
        $this->saveModel($model);
        return $this->success();
    }

    /**
     * @OA\Get(
     *     path="/carrier/{id}",
     *     tags={"carrier"},
     *     operationId="getCarrier",
     *     summary="getCarrier",
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
     *                 ref="#/components/schemas/CarrierLarge"
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

    public function actionShow($id)
    {
        $model = $this->findModel($id);
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Delete(
     *     path="/carrier/{id}",
     *     tags={"carrier"},
     *     operationId="deleteCarrier",
     *     summary="deleteCarrier",
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
     *      {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->delete();
        return $this->success();
    }
}
