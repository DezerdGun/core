<?php

namespace api\controllers;


use api\components\HttpException;
use common\models\LoadStop;

class LoadStopController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/load-stop",
     *     tags={"load-stop"},
     *     operationId="LoadStop",
     *     summary="createLoadStop",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *         @OA\Property(
     *              property="LoadStop[stop_type]",
     *              type="string",
     *              enum={"port","consignee","container_return","chassis_location"}
     *              ),
     *         @OA\Property(
     *              property="LoadStop[port_id]",
     *              type="integer",
     *              ),
     *         @OA\Property(
     *              property="LoadStop[company_id]",
     *              type="integer",
     *              ),
     *         @OA\Property(
     *              property="LoadStop[from]",
     *              type="date",
     *              format="date-time",
     *              pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *              example="2022-07-17 08:16:06",
     *              description="2022-08-17T10:40:52Z"
     *              ),
     *         @OA\Property(
     *              property="LoadStop[to]",
     *              type="date",
     *              format="date-time",
     *              pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *              example="2022-08-17 08:16:06",
     *              description="2022-09-17T10:40:52Z"
     *              ),
     *            )
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
     *                 ref="#/components/schemas/LoadStopSmall"
     *             )
     *         )
     *     ),
     *     security={
     *     {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionCreate()
    {
        $model = new LoadStop();
        if ($model->load( \Yii::$app->request->post() ) &&  $model->validate() && $model->save()) {
            return $this->success();
        } else {
            throw new HttpException(400,[$model->formName() => $model->getErrors()]);
        }
    }
}