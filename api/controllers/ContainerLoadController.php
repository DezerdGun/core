<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\load\Large;
use api\templates\load\Middle;
use api\templates\loaddocuments\Small;
use common\models\Date;
use common\models\Load;
use common\models\LoadDocuments;
use Yii;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class ContainerLoadController extends BaseController
{

    /**
     * @OA\Get(
     *     path="/container-load",
     *     tags={"container-load"},
     *     operationId="getContainerLoads",
     *     summary="getContainerLoads",
     *     @OA\Parameter(
     *         name="customer_id",
     *         in="query",
     *         required=false,
     *         description="{Fk} From Customer[id] Endpoint ",
     *         example="1",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="port_id",
     *         in="query",
     *         required=false,
     *         description="{Fk} From Location[id] Endpoint ",
     *         example="1",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="consignee_id",
     *         in="query",
     *         required=false,
     *         description="{Fk} From Location[id] Endpoint ",
     *         example="1",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="load_id",
     *         in="query",
     *         required=false,
     *         description="{Fk} From load_additional_info[id] Endpoint ",
     *         example="1",
     *         @OA\Schema(
     *             type="integer"
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

    public function actionIndex($customer_id = 0, $port_id = 0, $consignee_id = 0,
                                $page = 0, $load_id = 0, $pageSize = 25)
    {
        $query = Load::find();
        if ($customer_id) {
            $query->andWhere(['customer_id' => $customer_id]);
        } elseif ($port_id) {
            $query->andWhere(['port_id' => $port_id]);
        } elseif ($consignee_id) {
            $query->andWhere(['consignee_id' => $consignee_id]);
        } elseif ($load_id) {
            $query->andWhere(['id' => $load_id]);
        }
        return $this->index($query, $page, $pageSize, \api\templates\load\Small::class);
    }

    /**
     * @OA\Post(
     *     path="/container-load",
     *     tags={"container-load"},
     *     operationId="ContainerLoad",
     *     summary="createContainerLoad",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *         @OA\Property(
     *              property="Load[customer_id]",
     *              type="integer",
     *              description="{Fk} From Customer[id] Endpoint ",
     *              example="1",
     *              ),
     *         @OA\Property(
     *              property="Load[port_id]",
     *              type="integer",
     *              description="{Fk} From Location[id] Endpoint ",
     *              example="1",
     *              ),
     *         @OA\Property(
     *              property="Load[consignee_id]",
     *              type="integer",
     *              description="{Fk} From Location[id] Endpoint ",
     *              example="1",
     *              ),
     *          @OA\Property(
     *              property="Date[vessel_eta]",
     *              type="date",
     *              format="date-time",
     *              pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *              example="12-12-2021",
     *              description="12-12-2021"
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
     *      {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionCreate()
    {
        $model = new Load();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->status = $model::PENDING;
            $role = \Yii::$app->user->id;
            $subbroker = \Yii::$app->user->identity->findByRoleBroker($role);
            $masterBroker = \Yii::$app->user->identity->findByRoleMaster($role);
            $carrier = \Yii::$app->user->identity->findByRoleCarrier($role);
            $empty = \Yii::$app->user->identity->findByRoleEmpty($role);
            $date = new Date();
            if ($date->load(\Yii::$app->request->post()) && $date->validate()) {
                $date->save();
                if ($masterBroker && !$subbroker && !$carrier && !$empty) {
                    $model->user_id = $masterBroker->id;
                    $model->vessel_eta = $date->id;
                    $model->save();
                    return $this->success($model->getAsArray(Middle::class));
                } elseif (!$masterBroker && $subbroker && !$carrier && !$empty) {
                    $model->user_id = $subbroker->id;
                    $model->vessel_eta = $date->id;
                    $model->save();
                    return $this->success($model->getAsArray(Middle::class));
                } else {
                    throw new HttpException(400, 'You are not Broker');
                }
            } else {
                throw new HttpException(404, [$date->formName() => $date->getErrors()]);
            }
        } else {
            throw new HttpException(400,
                [$model->formName() => $model->getErrors()]);
        }
    }

    /**
     * @OA\Get(
     *     path="/container-load/{id}",
     *     tags={"container-load"},
     *     operationId="getContainerLoadId",
     *     summary="getContainerLoad",
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
     *     path="/container-load/{id}",
     *     tags={"container-load"},
     *     operationId="deleteContainerLoad",
     *     summary="deleteContainerLoad",
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
        return $this->success($model->getAsArray(Large::class));
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
     *      {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionCreateUploadDocument()
    {
        $model = new LoadDocuments();
        $model->upload_by = Yii::$app->user->id;
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

    public function actionDeleteDocument($id, $load_id)
    {
        $docdel = $this->findModelDoc($id, $load_id);
        $docdel->delete();
        return $this->success();
    }

    private function findModelDoc($id, $load_id)
    {
        $condition = ['id' => $id, 'load_id' => $load_id];
        $model = LoadDocuments::findOne($condition);
        if (!$model) {
            throw new HttpException(404, \Yii::t('app', 'ID не найден!'));
        }
        return $model;

    }

    private function findModel($id)
    {
        $condition = ['id' => $id];
        $model = Load::findOne($condition);
        $date = Date::findOne(['id' => $id]);
        if ($date){
            $date->delete();
        }else{
            throw new NotFoundHttpException();
        }
        if (!$model  && !$date) {
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
