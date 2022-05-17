<?php

namespace api\controllers;

use api\templates\carrier\Large;
use common\models\Carrier;
use api\components\HttpException;
use yii\web\NotFoundHttpException;
use Yii;

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
     *   @OA\RequestBody(
     *       description="CarrierCreate",
     *       @OA\JsonContent(ref="#/components/schemas/CarrierCreate"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               type="object",
     *               ref="#/components/schemas/CarrierCreate"
     *          ),
     *       )
     *   ),
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
        $model->load(Yii::$app->request->post());
        if (!$model->validate()) {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        $model->user_id = $_POST['user_id'];
        $model->mc = $_POST['mc'];
        $model->dot = $_POST['dot'];
        $model->ein = $_POST['ein'];
        $model->w9 = $_FILES['w9']['name'];
        $model->ic = $_POST['ic'];
        $model->save();
        return $model;
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
