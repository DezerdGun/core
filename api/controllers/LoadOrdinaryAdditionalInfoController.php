<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\loadOrdinaryAdditionalInfo\Large;
use common\models\LoadOrdinaryAdditionalInfo;
use yii\web\NotFoundHttpException;

class LoadOrdinaryAdditionalInfoController extends BaseController
{

    /**
     * @OA\Post(
     *     path="/load-ordinary-additional-info/create",
     *     tags={"ordinary-load"},
     *     operationId="LoadOrdinaryAdditionalInfo",
     *     summary="createLoadOrdinaryAdditionalInfo",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *         @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[load_id]",
     *              type="integer",
     *              description="1",
     *              example="1"
     *              ),
     *          @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[hazmat]",
     *              type="string",
     *              enum={"yes","no"},
     *              ),
     *          @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[hazmat_description]",
     *              type="string",
     *              ),
     *          @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[overweight]",
     *              type="string",
     *              enum={"yes","no"},
     *              ),
     *          @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[overweight_description]",
     *              type="string",
     *              ),
     *          @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[weight_in_LBs]",
     *              type="string",
     *              enum={"yes","no"},
     *              ),
     *          @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[weight_in_LBs_description]",
     *              type="string",
     *              ),
     *          @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[reefer]",
     *              type="string",
     *              enum={"yes","no"},
     *              ),
     *          @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[reefer_description]",
     *              type="string",
     *              ),
     *          @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[alcohol]",
     *              type="string",
     *              enum={"yes","no"},
     *              ),
     *          @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[alcohol_description]",
     *              type="string",
     *              ),
     *         @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[urgent]",
     *              type="string",
     *              enum={"yes","no"},
     *              ),
     *          @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[urgent_description]",
     *              type="string",
     *              ),
     *          @OA\Property(
     *              property="LoadOrdinaryAdditionalInfo[note]",
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
        $model = new \common\models\LoadOrdinaryAdditionalInfo();
        $role = \Yii::$app->user->id;
        $subbroker = \Yii::$app->user->identity->findByRoleBroker($role);
        $masterBroker = \Yii::$app->user->identity->findByRoleMaster($role);
        $carrier = \Yii::$app->user->identity->findByRoleCarrier($role);
        $empty = \Yii::$app->user->identity->findByRoleEmpty($role);
        if ($masterBroker && !$subbroker && !$carrier && !$empty){
            $this->feedUp($model);
            return $this->success($model);
        }elseif(!$masterBroker && $subbroker && !$carrier && !$empty){
            $this->feedUp($model);
            return $this->success($model);
        }else {
            throw new HttpException(400, 'You are not Broker');
        }
    }

    private function feedUp($model)
    {
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->save();
        } else {
            throw new HttpException(400,
                [$model->formName() => $model->getErrors()]);
        }
    }
}