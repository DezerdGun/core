<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\load\Large;
use api\templates\load\Small;
use common\models\Load;
use common\models\LoadStop;
use yii\web\NotFoundHttpException;


class LoadController extends BaseController
{

    /**
     * @OA\Get(
     *     path="/load",
     *     tags={"load"},
     *     operationId="getLoads",
     *     summary="getLoads",
     *     @OA\Parameter(
     *         name="customer_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="port_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="consignee_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="load_type",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="route_type",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="from",
     *         in="query",
     *         required=false,
     *         description="2022-07-17 08:16:06",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="to",
     *         in="query",
     *         required=false,
     *         description="2022-07-17",
     *         @OA\Schema(
     *             type="string"
     *         )
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
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/LoadSmall")
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 ref="#/components/schemas/Pagination"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionIndex($customer_id = 0, $port_id = 0, $consignee_id = 0, $load_type =0, $route_type = 0,
                                $from = 0, $to = 0,  $page = 0, $pageSize = 25)
    {
        $query = Load::find();
        if ($customer_id) {
            $query->andWhere(['customer_id' => $customer_id]);
        } elseif ($port_id) {
            $query->andWhere(['port_id' => $port_id]);
        } elseif ($consignee_id) {
            $query->andWhere(['consignee_id' => $consignee_id]);
        } elseif ($load_type) {
            $query->andWhere(['load_type' => $load_type]);
        } elseif ($route_type) {
            $query->andWhere(['route_type' => $route_type]);
        } elseif ($from) {
            $query = LoadStop::find();
            $query->andWhere(['from' => $from]);
        } elseif ($to) {
            $query = LoadStop::find();
            $query->andWhere(['to' => $to]);
        }
        return $this->index($query,$page, $pageSize, Large::class);
    }

    /**
     * @OA\Post(
     *     path="/load",
     *     tags={"load"},
     *     operationId="Load",
     *     summary="createLoad",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *         @OA\Property(
     *              property="Load[load_type]",
     *              type="string",
     *              enum={"Import","Export","Road","Bill Only"}
     *              ),
     *         @OA\Property(
     *              property="Load[customer_id]",
     *              type="integer",
     *              ),
     *         @OA\Property(
     *              property="Load[port_id]",
     *              type="integer",
     *              ),
     *         @OA\Property(
     *              property="Load[consignee_id]",
     *              type="integer",
     *              ),
     *         @OA\Property(
     *              property="Load[route_type]",
     *              type="string",
     *              ),
     *         @OA\Property(
     *              property="Load[order]",
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
     *                 ref="#/components/schemas/LoadSmall"
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
        $model = new Load();
        if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->success();
        } else {
            throw new HttpException(400,
                [$model->formName() => $model->getErrors()]);
        }
    }

    /**
     * @OA\Get(
     *     path="/load/{id}",
     *     tags={"load"},
     *     operationId="getLoadId",
     *     summary="getLoad",
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
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/LoadSmall"
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

    public function actionShow($id)
    {
        $model = $this->findModel($id);
        return $this->success($model->getAsArray(Small::class));
    }

    /**
     * @OA\Delete(
     *     path="/load/{id}",
     *     tags={"load"},
     *     operationId="deleteLoad",
     *     summary="deleteLoad",
     *     @OA\Parameter(
     *         name="id",
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
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->success();
    }

    private function findModel($id)
    {
        $condition = ['id' => $id];
        $model = Load::findOne($condition);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $model;

    }

}
