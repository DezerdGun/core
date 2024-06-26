<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\LoadContainerInfoService;
use api\templates\containerinfo\Small;
use api\templates\load\Large;
use common\models\LoadContainerInfo;
use common\models\Load;
use common\models\LoadReferenceNumber;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;

class LoadContainerInfoController extends BaseController
{

    public $loadContainerInfo;

    public function __construct($id, $module, $config = [],
                                loadContainerInfoService $loadContainerInfo
    )
    {
        parent::__construct($id, $module, $config);
        $this->loadContainerInfo = $loadContainerInfo;

    }
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
     *              example="25",
     *              description="25",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[size]",
     *              type="integer",
     *              enum={"53","45","40","20"}
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[type]",
     *              type="string",
     *              example="20GP",
     *              description="20GP",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[owner_id]",
     *              type="integer",
     *              example="1",
     *              description="1 => NSA",
     *              ),
     *         @OA\Property(
     *              property="LoadReferenceNumber[vessel_name]",
     *              type="string",
     *              example="Omega",
     *              description="Omega",
     *              ),
     *         @OA\Property(
     *              property="LoadReferenceNumber[mbl]",
     *              type="string",
     *              example="235",
     *              description="235",
     *              ),
     *         @OA\Property(
     *              property="LoadReferenceNumber[hbl]",
     *              type="string",
     *              example="523",
     *              description="523",
     *              ),
     *         @OA\Property(
     *              property="LoadContainerInfo[weight_in_LBs]",
     *              type="integer",
     *              example="9.000",
     *              description="9.000",
     *              ),
     *          required={
     *                     "LoadContainerInfo[size]",
     *                     "LoadContainerInfo[container_number]",
     *                     "LoadContainerInfo[owner_id]",
     *                     "LoadReferenceNumber[mbl]",
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

    public function actionCreate(): array
    {
        $model = new LoadContainerInfo();
        $role = \Yii::$app->user->id;
        $subbroker = \Yii::$app->user->identity->findByRoleBroker($role);
        $masterBroker = \Yii::$app->user->identity->findByRoleMaster($role);
        $carrier = \Yii::$app->user->identity->findByRoleCarrier($role);
        $empty = \Yii::$app->user->identity->findByRoleEmpty($role);
        $loadReferenceNumber = new LoadReferenceNumber();
        if ($loadReferenceNumber->load(\Yii::$app->request->post()) && $loadReferenceNumber->validate()) {
            if ($masterBroker && !$subbroker && !$carrier && !$empty) {
                $this->feedUp($model,$loadReferenceNumber);
                return $this->success($model->getAsArray(Small::class));
            } elseif (!$masterBroker && $subbroker && !$carrier && !$empty) {
                $this->feedUp($model,$loadReferenceNumber);
                return $this->success($model->getAsArray(Small::class));
            } else {
                throw new HttpException(400, 'You are not Broker');
            }
        }else {
            throw new HttpException(404, [$loadReferenceNumber->formName() => $loadReferenceNumber->getErrors()]);
        }
    }

    private function feedUp($model,$loadReferenceNumber)
    {
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            $loadReferenceNumber->load_id = $model->id;
            $loadReferenceNumber->save();
        } else {
            throw new HttpException(400,
                [$model->formName() => $model->getErrors()]);
        }
    }

    /**
     * @OA\Patch (
     *     path="/load-container-info/{id}",
     *     tags={"container-load"},
     *     operationId="updateLoadContainerInfo",
     *     summary="updateLoadContainerInfo",
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
     *             mediaType="application/json",
     *             @OA\Schema(
     *                      @OA\Property(
     *                          property="container_number",
     *                          type="integer",
     *                          example="434332",
     *                          description="NumberContainer",
     *                 ),
     *                      @OA\Property(
     *                          property="size",
     *                          type="integer",
     *                          example="53",
     *                          description="SizeContainerOwner",
     *                 ),
     *                      @OA\Property(
     *                          property="type",
     *                          type="string",
     *                          example="20TD",
     *                          description="TypeContainerOwner",
     *                 ),
     *                      @OA\Property(
     *                          property="owner_id",
     *                          type="integer",
     *                          example="1",
     *                          description="ContainerOwner",
     *                 ),
     *                      @OA\Property(
     *                          property="chassis",
     *                          type="string",
     *                 ),
     *                       @OA\Property(
     *                          property="chassis_size",
     *                          type="integer",
     *                 ),
     *                      @OA\Property(
     *                          property="chassis_type",
     *                          type="string",
     *                          example="20TN",
     *                          description="code Container",
     *                 ),
     *                      @OA\Property(
     *                          property="chassis_owner_id",
     *                          type="integer",
     *                 ),
     *                      @OA\Property(
     *                          property="chassis_genset",
     *                          type="string",
     *                 ),
     *                      @OA\Property(
     *                          property="weight_in_LBs",
     *                          type="integer",
     *                          example="9.000",
     *                          description="decimal()",
     *                 ),
     *                       required={
     *                              "size",
     *                              "container_number",
     *                              "type",
     *                              "owner_id",
     *              },
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
     *              @OA\Property(
     *                  property="description",
     *                  type="string",
     *                  example="1) create container-load 2) create container-info, then You can update container info"
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
        $this->loadContainerInfo->update($id);
        return $this->success();
    }



}
