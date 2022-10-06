<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\loadbid\Large;
use api\templates\loadbiddetails\Small;
use common\models\load_modes;
use common\models\LoadBid;
use common\models\LoadBidDetails;
use kartik\form\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class LoadBidController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/load/{load_id}/bids",
     *     tags={"load-bid"},
     *     operationId="getLoadBidId",
     *     summary="getLoadBidId",
     *     @OA\Parameter(
     *         name="load_id",
     *         in="path",
     *         required=true
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
     *          @OA\Property(
     *                 property="data",
     *                 type="object",
     *          @OA\Property(
     *              property="LoadBid[load_id]",
     *              type="object",
     *          @OA\Property(
     *              property="LoadBidDetails[load_id]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[charge_code]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[price]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_count]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_measure]",
     *              type="string",
     *              enum={"Perday","Perhour","Permiles","Perpounds","Fixed","Percentage"}
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[free_units]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[notes]",
     *              type="text",
     *              ),
     *              ),
     *             ),
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *
     *     }
     * )
     */

    public function actionGetLoadBidId($load_id)
    {
        $model = $this->findModel($load_id);
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Get(
     *     path="/load/{load_id}/bid/{id}",
     *     tags={"load-bid"},
     *     operationId="getLoadBid",
     *     summary="getLoadBid",
     *     @OA\Parameter(
     *         name="load_id",
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true
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
     *          @OA\Property(
     *                 property="data",
     *                 type="object",
     *          @OA\Property(
     *              property="LoadBid[load_id]",
     *              type="object",
     *          @OA\Property(
     *              property="LoadBidDetails[load_id]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[charge_code]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[price]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_count]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_measure]",
     *              type="string",
     *              enum={"Perday","Perhour","Permiles","Perpounds","Fixed","Percentage"}
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[free_units]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[notes]",
     *              type="text",
     *              ),
     *              ),
     *             ),
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *
     *     }
     * )
     */

    public function actionGetLoadBid($load_id, $id)
    {
        $model = $this->findLoadBid($load_id, $id);
        return $this->success($model->getAsArray(Small::class));
    }

    private function findLoadBid($load_id, $id)
    {
        $con = LoadBid::find()->where(['load_id' => $load_id])->all();
        if ($con) {
            $condition = ['id' => $id];
            $model = LoadBidDetails::findOne($condition);
        } else {
            throw new HttpException(404, \Yii::t('app', 'ID не найден!'));
        }
        return $model;

    }

    private function findModel($load_id)
    {
        $condition = ['load_id' => $load_id];
        $model = LoadBid::findOne($condition);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $model;

    }

    /**
     * @OA\Post(
     *     path="/load{load_id}/bid",
     *     tags={"load-bid"},
     *     operationId="createLoadBid",
     *     summary="createLoadBid",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *          @OA\Property(
     *              property="LoadBid[load_id]",
     *              type="integer",
     *              ),
     *          @OA\Property(
     *              property="LoadBidDetails[load_id]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[charge_code]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[price]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_count]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_measure]",
     *              type="string",
     *              enum={"Perday","Perhour","Permiles","Perpounds","Fixed","Percentage"}
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[free_units]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[notes]",
     *              type="text",
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
     *          @OA\Property(
     *                 property="data",
     *                 type="object",
     *          @OA\Property(
     *              property="LoadBid[load_id]",
     *              type="integer",
     *              ),
     *          @OA\Property(
     *              property="LoadBidDetails[load_bid_id]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[charge_code]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[price]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_count]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_measure]",
     *              type="string",
     *              enum={"Perday","Perhour","Permiles","Perpounds","Fixed","Percentage"}
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[free_units]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[notes]",
     *              type="text",
     *              ),
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
        $model = new LoadBid();
        $model->carrier_id = \Yii::$app->user->id;
        $model->date = date("Y-m-d H:i:s");
        if ($model->load($this->getAllowedPost()) && $model->validate()) {
            $model->save();
            if ($model->save()) {
                $detail = new LoadBidDetails();
                $detail->load_bid_id = $model->load_id;
                if ($detail->load($this->getAllowedPost()) && $detail->validate()) {
                    $this->saveModel($detail);
                } else {
                    throw new HttpException(404, [$detail->formName() => $detail->getErrors()]);
                }
                return $this->success($model->getAsArray(Large::class));

            }
        } else {
            throw new HttpException(404, [$model->formName() => $model->getErrors()]);
        }
    }

    /**
     * @OA\Delete(
     *     path="/load/{load_id}/bid/{id}",
     *     tags={"load-bid"},
     *     operationId="deleteLoadBidDetails",
     *     summary="deleteLoadBidDetails",
     *     @OA\Parameter(
     *         name="load_id",
     *         in="path",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
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
     *          @OA\Property(
     *                 property="data",
     *                 type="object",
     *          @OA\Property(
     *              property="LoadBid[load_id]",
     *              type="integer",
     *              ),
     *          @OA\Property(
     *              property="LoadBidDetails[load_id]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[charge_code]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[price]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_count]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_measure]",
     *              type="string",
     *              enum={"Perday","Perhour","Permiles","Perpounds","Fixed","Percentage"}
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[free_units]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[notes]",
     *              type="text",
     *              ),
     *             ),
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionLoadBidDetailsDelete($load_id, $id)
    {
        $model = LoadBidDetails::findOne(['id' => $id]);
        $con = LoadBid::findOne(['load_id' => $load_id]);
        if (!$con && !$model || !$con && $model || $con && !$model) {
            throw new HttpException(404, \Yii::t('app', 'Id или load_id не найден!'));
        } else {
            $con->delete();
            return $con;
        }
    }


    /**
     * Update
     * @OA\Put (
     *     path="/load/{load_id}/bid",
     *     tags={"load-bid"},
     *     operationId="updateLoadBidIdDetails",
     *     summary="updateLoadBidIdDetails",
     *     @OA\Parameter(
     *         in="path",
     *         name="load_id",
     *         required=true,
     *         @OA\Schema(
     *          type="integer"
     *          )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *           @OA\Property(
     *              property="LoadBidDetails[charge_code]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[price]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_count]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_measure]",
     *              type="string",
     *              enum={"Perday","Perhour","Permiles","Perpounds","Fixed","Percentage"}
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[free_units]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[notes]",
     *              type="text",
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
     *          @OA\Property(
     *                 property="data",
     *                 type="object",
     *          @OA\Property(
     *              property="LoadBid[load_id]",
     *              type="integer",
     *              ),
     *          @OA\Property(
     *              property="LoadBidDetails[load_bid_id]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[charge_code]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[price]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_count]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[unit_measure]",
     *              type="string",
     *              enum={"Perday","Perhour","Permiles","Perpounds","Fixed","Percentage"}
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[free_units]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[notes]",
     *              type="text",
     *              ),
     *             ),
     *         )
     *     ),
     *      security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *
     *     }
     *  )
     */

    public function actionUpdateLoadBidDetails($load_id)
    {
        $model = $this->findModel($load_id);
        $loadId = $this->findModelLoadId($model->id);
        $loadId->load($this->getAllowedPost(), 'LoadBidDetails');
        $this->saveModel($loadId);
        return $this->success();


    }

    public function findModelLoadId($model)
    {
        $conditions = ['load_bid_id' => $model];
        $models = LoadBidDetails::findOne($conditions);
        if (!$models) {
            throw new NotFoundHttpException();
        }
        return $models;

    }
}