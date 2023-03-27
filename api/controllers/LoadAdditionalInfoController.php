<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\additionalinfo\Small;
use common\models\LoadAdditionalInfo;
use OpenApi\Annotations as OA;

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
     *              property="LoadAdditionalInfo[overweight_description]",
     *              type="string",
     *              ),
     *          @OA\Property(
     *              property="LoadAdditionalInfo[reefer]",
     *              type="string",
     *              enum={"yes","no"},
     *              ),
     *          @OA\Property(
     *              property="LoadAdditionalInfo[reefer_description]",
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
     *              property="LoadAdditionalInfo[note]",
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
     *      {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     * @throws HttpException
     */

    public function actionCreate()
    {
        $model = new LoadAdditionalInfo();
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

    /**
     * @throws HttpException
     */
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