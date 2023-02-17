<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\load\Large;
use api\templates\load\Middle;
use api\templates\loaddocuments\Small;
use common\enums\LoadStatus;
use common\models\Date;
use common\models\Load;
use common\models\LoadContainerInfo;
use common\models\LoadDocuments;
use common\models\search\SearchLoadContainer;
use OpenApi\Annotations as OA;
use Yii;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class ContainerLoadController extends BaseController
{

    /**
     * @OA\Patch (
     *     path="/container-load/status/{id}",
     *     tags={"container-load"},
     *     operationId="changeContainerLoadId",
     *     summary="changeContainerLoadId",
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
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  @OA\Property(
     *                      property="UpdateStatusForm[status]",
     *                      type="string",
     *                      enum={"Pending","in_Progress", "Completed","Cancelled"}
     *                  ),
     *                  required={
     *                      "UpdateStatusForm[status]",
     *                  }
     *            )
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
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="id",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         type="string",
     *                          example=" Cancelled -> CANCELLED,Completed -> COMPLETED,   in_Progress -> IN_PROGRESS ,Pending -> PENDING"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     */

    public function actionReassign($id): array
    {
        $condition = ['id' => $id];
        $model = Load::findOne($condition);
        if ($model) {
            $model->load(\Yii::$app->getRequest()->post(), 'UpdateStatusForm') && $model->validate();
            $model->save();
        }
        return $this->success($model);
    }



    /**
     * @OA\Get(
     *     path="/container-load/count",
     *     tags={"container-load"},
     *     operationId="getLoadCountStatus",
     *     summary="getLoadCountStatus",
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
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="id",
     *                         type="string"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         type="string",
     *                          example=" Cancelled -> CANCELLED,Completed -> COMPLETED,   in_Progress -> IN_PROGRESS ,Pending -> PENDING"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionActive(): array
    {
        $user = Load::find()
            ->select(['status','COUNT(status) as number'])
            ->where([
                'status' => [
                    LoadStatus::CANCELLED,
                    LoadStatus::COMPLETED,
                    LoadStatus::IN_PROGRESS,
                    LoadStatus::PENDING,
                    LoadStatus::ARCHIVED
                ],
            ])
            ->groupBy(['status'])
            ->asArray()
            ->all();
        return $this->success($user);
    }
    /**
     * @OA\Get(
     *     path="/container-load/status",
     *     tags={"container-load"},
     *     operationId="getContainerLoadsStatus",
     *     summary="getContainerLoadsStatus",
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         required=false,
     *
     *         description="Pending,in_Progress,Completed,Cancelled",
     *         example="Pending",
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
     *                 @OA\Items(ref="#/components/schemas/LoadLarge")
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

    public function actionStatus($status = 0,$page = 0,  $pageSize = 10)
    {
        $query = Load::find();
        if ($status) {
            $query->andWhere(['status' => $status]);
        }
        return $this->index($query, $page, $pageSize, Large::class);

    }

    /**
     * @OA\Get(
     *     path="/container-load",
     *     tags={"container-load"},
     *     operationId="getContainerLoads",
     *     summary="getContainerLoads",
     *    @OA\Parameter(
     *         name="SearchLoadContainer[id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *    @OA\Parameter(
     *         name="SearchLoadContainer[customer_id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *    @OA\Parameter(
     *         name="SearchLoadContainer[status][]",
     *         in="query",
     *         required=false,
     *         description="Pending, in_Progress, Completed,Cancelled,archived",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                  type="string"
     *             ),
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchLoadContainer[port_state_code][]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="array",
     *                 @OA\Items(
     *                     type="string"
     *                 ),
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchLoadContainer[destination_state_code][]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="array",
     *                 @OA\Items(
     *                     type="string"
     *                 ),
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchLoadContainer[vessel_eta_from]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="date",
     *              pattern="^([0-9]{4})-(?:[0-9]{2})-([0-9]{2})$"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchLoadContainer[vessel_eta_to]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="date",
     *              pattern="^[0-9]{4}-[0-9]{2}-[0-9]{2}$"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchLoadContainer[size]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="SearchLoadContainer[type]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchLoadContainer[owner_id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             default=0
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page_size",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             default=10
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
     *                 @OA\Items(ref="#/components/schemas/LoadLarge")
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

    public function actionIndex($page = 0, $pageSize = 10): array
    {
        $searchLoadContainer = new SearchLoadContainer();
        $searchLoadContainer->load(Yii::$app->request->queryParams);
        if ( $searchLoadContainer->validate()) {
            $query =  $searchLoadContainer->search();
        } else {
            throw new HttpException(400, ['SearchLoadContainer' => $searchLoadContainer->getErrors()]);
        }
        return $this->index($query, $page, $pageSize, Large::class);

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
     *          required={
     *                     "Load[customer_id]",
     *                     "Load[port_id]",
     *                     "Load[consignee_id]",
     *                     "Date[vessel_eta]",
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
     *                 ref="#/components/schemas/LoadSmall"
     *             )
     *         )
     *     ),
     *     security={
     *      {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     * @throws \yii\base\InvalidConfigException
     */

    public function actionCreate(): array
    {
        $model = new Load();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status = $model::PENDING;
            $role = Yii::$app->user->id;
            $subbroker = Yii::$app->user->identity->findByRoleBroker($role);
            $masterBroker = Yii::$app->user->identity->findByRoleMaster($role);
            $carrier = Yii::$app->user->identity->findByRoleCarrier($role);
            $empty = Yii::$app->user->identity->findByRoleEmpty($role);
            $date = new Date();
            if ($date->load(Yii::$app->request->post()) && $date->validate()) {
                $date->save();
                if ($masterBroker && !$subbroker && !$carrier && !$empty) {
                    $model->user_id = $masterBroker->id;
                    $model->vessel_eta = $date->id;
                    $model->save();
                    return $this->success($model->getAsArray(Large::class));
                } elseif (!$masterBroker && $subbroker && !$carrier && !$empty) {
                    $model->user_id = $subbroker->id;
                    $model->vessel_eta = $date->id;
                    $model->save();
                    return $this->success($model->getAsArray(Large::class));
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
        $model = $this->findModels($id);
        return $this->success($model->getAsArray(Large::class));
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
     * @throws NotFoundHttpException
     * @throws \yii\db\StaleObjectException
     */

    public function actionDelete($id)
    {
        $model = $this->findModels($id);
        $model->status = LoadStatus::ARCHIVED;
        $model->update();
        return $this->success($model->getAsArray(Large::class));
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

    private function findModels($id): Load
    {
        $con = ['id' => $id];
        $model = Load::findOne($con);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $model;
    }


}
