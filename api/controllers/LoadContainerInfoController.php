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
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[number]",
     *              type="integer",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[size]",
     *              type="string",
     *              enum={"53'","45'","40'","20'"}
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[type]",
     *              type="string",
     *              enum={"Import","Export","Road","Bill Only"}
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[owner]",
     *              type="integer",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[vessel_name]",
     *              type="string",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[mbl]",
     *              type="string",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[hbl]",
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
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/LoadContainerInfoSmall"
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
        $model = new LoadContainerInfo();
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