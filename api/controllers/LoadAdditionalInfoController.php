<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\containerinfo\Small;
use common\models\LoadAdditionalInfo;
use common\models\LoadContainerInfo;

class LoadAdditionalInfoController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/load-additional-info",
     *     tags={"container-load"},
     *     operationId="LoadAdditionalInfo",
     *     summary="createLoadAdditionalInfo",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *         @OA\Property(
     *              property="LoadAdditionalInfo[load_id]",
     *              type="integer",
     *              ),
     *          @OA\Property(
     *              property="LoadAdditionalInfo[hazmat]",
     *              type="string",
     *              enum={"yes","no"},
     *              ),
     *          @OA\Property(
     *              property="LoadAdditionalInfo[hazmat_description]",
     *              type="string",
     *              ),
     *          @OA\Property(
     *              property="LoadAdditionalInfo[overweight]",
     *              type="string",
     *              enum={"yes","no"},
     *              ),
     *          @OA\Property(
     *              property="LoadAdditionalInfo[weight_in_lbs]",
     *              type="string",
     *              ),
     *          @OA\Property(
     *              property="LoadAdditionalInfo[reefer]",
     *              type="string",
     *              enum={"yes","no"},
     *              ),
     *          @OA\Property(
     *              property="LoadAdditionalInfo[temp_in_f]",
     *              type="string",
     *              ),
     *           @OA\Property(
     *              property="LoadAdditionalInfo[alcohol]",
     *              type="string",
     *              enum={"yes","no"},
     *              ),
     *          @OA\Property(
     *              property="LoadAdditionalInfo[alcohol_description]",
     *              type="string",
     *              ),
     *          @OA\Property(
     *              property="LoadAdditionalInfo[urgent]",
     *              type="string",
     *              enum={"yes","no"},
     *              ),
     *          @OA\Property(
     *              property="LoadAdditionalInfo[urgent_description]",
     *              type="string",
     *              ),
     *          @OA\Property(
     *              property="LoadAdditionalInfo[note_from_broker]",
     *              type="string",
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
     *         )
     *     ),
     *     security={
     *     {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionCreate()
    {
        $model = new LoadAdditionalInfo();
            if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->success($model->getAsArray(\api\templates\additionalinfo\Small::class));
        } else {
            throw new HttpException(400,
                [$model->formName() => $model->getErrors()]);
        }
    }
}