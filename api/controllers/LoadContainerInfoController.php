<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\containerinfo\Small;
use api\templates\load\Large;
use common\models\LoadContainerInfo;
use common\models\Load;

class LoadContainerInfoController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/load-container-info",
     *     tags={"container-load"},
     *     operationId="LoadContainerInfo",
     *     summary="createLoadContainerInfo",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *         @OA\Property(
     *              property="LoadContainerInfo[load_id]",
     *              type="integer",
     *              example="1",
     *              description="1",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[container_number]",
     *              type="integer",
     *              example="100741",
     *              description="100741",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[size]",
     *              type="string",
     *              enum={"53'","45'","40'","20'"}
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[type]",
     *              type="string",
     *              example="20GP",
     *              description="20GP",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[owner]",
     *              type="integer",
     *              example="1",
     *              description="1 => NSA",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[vessel_name]",
     *              type="string",
     *              example="Omega",
     *              description="Omega",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[mbl]",
     *              type="string",
     *              example="235",
     *              description="235",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[hbl]",
     *              type="string",
     *              example="523",
     *              description="523",
     *              ),
     *          required={
     *                     "LoadContainerInfo[size]",
     *                     "LoadContainerInfo[container_number]",
     *                     "LoadContainerInfo[owner]",
     *                     "LoadContainerInfo[mbl]",
     *              }
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
     *                 ref="#/components/schemas/LoadContainerInfoSmall"
     *             )
     *         )
     *     ),
     *     security={
     *     {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionCreate()
    {
        $model = new LoadContainerInfo();
        $model->load_reference_number = rand(10000,9999999);
        $role = \Yii::$app->user->id;
        $subbroker = \Yii::$app->user->identity->findByRoleBroker($role);
        $masterBroker = \Yii::$app->user->identity->findByRoleMaster($role);
        $carrier = \Yii::$app->user->identity->findByRoleCarrier($role);
        $empty = \Yii::$app->user->identity->findByRoleEmpty($role);
        if ($masterBroker && !$subbroker && !$carrier && !$empty){
            $this->feedUp($model);
            return $this->success($model->getAsArray(Small::class));
        }elseif(!$masterBroker && $subbroker && !$carrier && !$empty){
            $this->feedUp($model);
            return $this->success($model->getAsArray(Small::class));
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