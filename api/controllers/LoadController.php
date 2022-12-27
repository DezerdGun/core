<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\load\Large;
use api\templates\loaddocuments\Small;
use common\models\Load;
use common\models\LoadAdditionalInfo;
use common\models\LoadContainerInfo;
use common\models\LoadDocuments;
use common\models\LoadStop;
use Yii;
use yii\helpers\FileHelper;
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
     *         required=true,
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
     *         name="load_status",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="vessel_eta",
     *         in="query",
     *         required=false,
     *         description="2022-07-17 08:16:06",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="broker_name",
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

    public function actionIndex($customer_id = 0, $port_id = 0, $consignee_id = 0,$load_status = 0, $vessel_eta =0, $broker_name = 0,
                                $from = 0, $to = 0,  $page = 0, $pageSize = 25)
    {
        $query = Load::find();
        if ($customer_id) {
            $query->andWhere(['customer_id' => $customer_id]);
        } elseif ($port_id) {
            $query->andWhere(['port_id' => $port_id]);
        } elseif ($consignee_id) {
            $query->andWhere(['consignee_id' => $consignee_id]);
        }  elseif ($load_status) {
            $query->andWhere(['load_status' => $load_status]);
        }elseif ($vessel_eta) {
            $query->andWhere(['vessel_eta' => $vessel_eta]);
        } elseif ($broker_name) {
            $query->andWhere(['broker_name' => $broker_name]);
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
     *          @OA\Property(
     *              property="Load[load_status]",
     *              type="integer",
     *              ),
     *          @OA\Property(
     *              property="Load[vessel_eta]",
     *              type="date",
     *              format="date-time",
     *              pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *              example="2021-12-12 14:05:22",
     *              description="2021-12-12T19:05:33Z"
     *              ),
     *         @OA\Property(
     *              property="Load[broker_name]",
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
        if ($model->load(\Yii::$app->request->post())  && $model->save()) {
            return $this->success($model->getAsArray(Large::class));
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
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
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
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *
     *     }
     * )
     */

    public function actionShow($id)
    {
        $model = $this->findModel($id);
        return $this->success($model->getAsArray(\api\templates\load\Small::class));
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
        return $this->success($model->getAsArray(\api\templates\load\Large::class));
    }

    /**
     * @OA\Get(
     *     path="/load/{id}/documents",
     *     tags={"load-documents"},
     *     operationId="getLoadDocuments",
     *     summary="getLoadDocuments",
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
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionGetDocuments($id)
    {
        $model = $this->findLoadDoc($id);
        return $this->success($model->getAsArray(\api\templates\loaddocuments\Large::class));
    }

    /**
     * @OA\Post(
     *     path="/load/{id}/document",
     *     tags={"load-documents"},
     *     operationId="getLoadDocumentID",
     *     summary="uploadLoadDocument",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *          @OA\Property(
     *              property="LoadDocuments[load_id]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *               property="LoadDocuments[filename]",
     *               type="string",
     *               format="binary"
     *                 ),
     *          @OA\Property(
     *              property="LoadDocuments[doc_type]",
     *              type="integer",
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

    public function actionCreateUploadDocument()
    {
        $model = new LoadDocuments();
        $model->upload_by =Yii::$app->user->id;
        $model->setScenario(LoadDocuments::SCENARIO_INSERT);
        if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->success($model->getAsArray(Small::class));
        } else {
            throw new HttpException(400,
                [$model->formName() => $model->getErrors()]);
        }
    }

    /**
     * @OA\Delete(
     *     path="/load/{load_id}/document/{id}",
     *     tags={"load-documents"},
     *     operationId="deleteLoadDocument",
     *     summary="deleteLoadDocument",
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

    public function actionDeleteDocument($id,$load_id)
    {
        $docdel = $this->findModelDoc($id,$load_id);
        $docdel->delete();
        return $this->success();
    }

    private function findModelDoc($id,$load_id)
    {
        $condition = ['id' => $id,'load_id' => $load_id];
        $model = LoadDocuments::findOne($condition);
        if (!$model){
            throw new HttpException(404,\Yii::t('app', 'ID не найден!'));
        }
        return $model;

    }

    private function findModel($id)
    {
        $condition = ['id' => $id];
        $model = Load::findOne($condition);
        if (!$model){
            throw new NotFoundHttpException();
        }
        return $model;
    }

    private function findLoadDoc($id)
    {
        $condition = ['id' => $id];
        $model = LoadDocuments::findOne($condition);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $model;
    }

}
