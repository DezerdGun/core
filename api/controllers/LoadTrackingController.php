<?php

namespace api\controllers;

use api\forms\tracking\LoadTrackingForm;
use common\models\LoadTracking;
use yii\web\HttpException;
use yii\db\Query;

class LoadTrackingController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/tracking{load_id}",
     *     tags={"load-tracking"},
     *     operationId="createLoadtracking",
     *     summary="createLoadtracking",
     *     requestBody={"$ref":"#/components/requestBodies/LoadTrackingForm"},
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
     *                 ref="#/components/schemas/TrackingSmall"
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
        $model = new LoadTrackingForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->tracking();
            return $model;
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }

    /**
     * @OA\Get(
     *     path="/tracking/{load_id}/list",
     *     tags={"load-tracking"},
     *     operationId="getLoadTracking",
     *     summary="getLoadTracking",
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
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/TrackingLarge"
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

    public function actionIndex($load_id)
    {
        $rows = (new Query())
            ->select(['id', 'load_id', 'created', 'lat', 'long'])
            ->from('load_tracking')
            ->where(['load_id' => $load_id])
            ->andWhere("created > NOW() - INTERVAL '1 hour'")
            ->all();
        return $this->success($rows);
    }

}