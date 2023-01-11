<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\loadbid\Large;
use api\templates\loadbiddetails\Small;
use common\models\LoadBid;
use common\models\LoadBidDetails;
use OpenApi\Annotations as OA;
use yii\web\NotFoundHttpException;

class LoadBidController extends BaseController
{
    const now_created = 0;
    const one_time = 1;
    const two_times = 2;

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
        if ($model) {
            return $this->success($model->getAsArray(Small::class));
        } else {
            throw new HttpException(404, \Yii::t('app', 'ID не найден!'));
        }

    }

    private function findLoadBid($load_id, $id)
    {
        $con = LoadBid::find()->where(['load_id' => $load_id])->all();
        if ($con) {
            $condition = ['id' => $id];
            $model = LoadBidDetails::findOne($condition);
        } else {
            throw new HttpException(404, \Yii::t('app', 'Load Id не найден!'));
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
     *     path="/load/{load_id}/bid",
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
     *              property="LoadBidDetails[unit_measure]",
     *              type="string",
     *              enum={"Perday","Perhour","Permiles","Perpounds","Fixed","Percentage"}
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[free_units]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[note_from_carrier]",
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
     *              property="LoadBidDetails[unit_measure]",
     *              type="string",
     *              enum={"Perday","Perhour","Permiles","Perpounds","Fixed","Percentage"}
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[free_units]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[note_from_carrier]",
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
                $detail->edit_bid_details = self::now_created;
                if ($detail->load($this->getAllowedPost()) && $detail->validate()) {
                    $detail->addNote(sprintf(
                        'Load_Bid_Details load_bid_id %d. charge_code: %d. price: %d. 
                            unit_measure: %s.free_units: %d.notes: %s',
                        $detail->load_bid_id, $detail->charge_code, $detail->price, $detail->unit_measure,
                        $detail->free_units, $detail->note_from_carrier
                    ));
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
     *              property="LoadBidDetails[unit_measure]",
     *              type="string",
     *              enum={"Perday","Perhour","Permiles","Perpounds","Fixed","Percentage"}
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[free_units]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[note_from_carrier]",
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
     *              property="LoadBidDetails[unit_measure]",
     *              type="string",
     *              enum={"Perday","Perhour","Permiles","Perpounds","Fixed","Percentage"}
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[free_units]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[note_from_carrier]",
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
     *              property="LoadBidDetails[unit_measure]",
     *              type="string",
     *              enum={"Perday","Perhour","Permiles","Perpounds","Fixed","Percentage"}
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[free_units]",
     *              type="number",
     *              ),
     *           @OA\Property(
     *              property="LoadBidDetails[note_from_carrier]",
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
        if ($loadId->edit_bid_details === 0) {
            $loadId->edit_bid_details = self::one_time;
            $loadId->load($this->getAllowedPost(), 'LoadBidDetails');
            $this->saveModel($loadId);
            $loadId->upEditDetails($loadId);
        } elseif ($loadId->edit_bid_details === 1) {
            $loadId->edit_bid_details = self::two_times;
            $loadId->load($this->getAllowedPost(), 'LoadBidDetails');
            $this->saveModel($loadId);
            $loadId->upEditDetails($loadId);
        } else {
            throw new HttpException(404, \Yii::t('app', 'Something has error'));
        }
        return $this->success($model->getAsArray(\api\templates\loadbid\Small::class));
    }

    public function findModelLoadId($model)
    {
        $conditions = ['load_bid_id' => $model];
        $model = LoadBidDetails::findOne($conditions);

        if (!$model) {
            throw new NotFoundHttpException();
        } elseif ($model->edit_bid_details == 2) {
            throw new HttpException(404, \Yii::t('app', 'Sorry! You edited 2 times!'));
        }
        return $model;

    }
}