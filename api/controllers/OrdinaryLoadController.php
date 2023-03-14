<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\LoadOrdinaryReferenceNumberService;
use api\khalsa\services\LoadOrdinaryService;
use api\templates\ordinaryload\Large;
use api\templates\ordinaryload\Small;
use common\enums\LoadStatus;
use common\models\Load;
use common\models\OrdinaryLoad;
use common\models\OrdinaryNeeded;
use common\models\search\SearchLoadOrdinary;
use common\models\User;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

class OrdinaryLoadController extends BaseController
{

    public $loadOrdinaryService;


    public function __construct($id, $module, $config = [],
                                LoadOrdinaryService $loadOrdinaryService

    )
    {
        parent::__construct($id, $module, $config);
        $this->loadOrdinaryService = $loadOrdinaryService;

    }

    /**
     * @OA\Get(
     *     path="/ordinary-load/{id}",
     *     tags={"ordinary-load"},
     *     operationId="getLoadOrdinaryId",
     *     summary="getLoadOrdinaryId",
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
     *                 ref="#/components/schemas/OrdinaryloadLarge"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *
     *     }
     * )
     * @throws NotFoundHttpException
     */

    public function actionShow($id): array
    {
        $model = $this->findModels($id);
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @throws NotFoundHttpException
     */
    private function findModels($id): OrdinaryLoad
    {
        $con = ['id' => $id];
        $model = OrdinaryLoad::findOne($con);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $model;
    }

    /**
     * @OA\Post(
     *     path="/ordinary-load",
     *     tags={"ordinary-load"},
     *     operationId="OrdinaryLoad",
     *     summary="createOrdinaryLoad",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *          encoding={
     *             "OrdinaryNeeded[ordinary_need][]": {
     *                 "explode": true
     *             },
     *         },
     *             @OA\Schema(
     *         @OA\Property(
     *              property="OrdinaryLoad[customer_id]",
     *              type="integer",
     *              example="1",
     *              format="Number{ForeignKey}",
     *              description="OrdinaryLoad[ForeignKey]TO[Company]"
     *              ),
     *          @OA\Property(
     *              property="OrdinaryLoad[origin_id]",
     *              type="integer",
     *              format="Number{ForeignKey}",
     *              example="1",
     *              description="Origin[ForeignKey]TO[Location]"
     *              ),
     *          @OA\Property(
     *              property="OrdinaryLoad[destination_id]",
     *              type="integer",
     *              format="Number{ForeignKey}",
     *              example="1",
     *              description="Destination[ForeignKey]TO[Location]"
     *              ),
     *          @OA\Property(
     *                 property="OrdinaryNeeded[ordinary_need][]",
     *                 type="array",
     *                 @OA\Items(
     *                     type="string"
     *                 ),
     *                 example={"V", "2F"}
     *             ),
     *         @OA\Property(
     *              property="OrdinaryLoad[pick_up_date]",
     *              type="date",
     *              format="date-time",
     *              pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *              example="2022-08-17 08:16:06",
     *              description="2022-09-17T10:40:52Z"
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
     *                 ref="#/components/schemas/OrdinaryloadLarge"
     *             )
     *         )
     *     ),
     *     security={
     *     {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     * @throws InvalidConfigException
     * @throws HttpException
     * @throws Exception
     */

    public function actionCreate(): array
    {

        $model = $this->loadOrdinaryService->create();
        return $this->success($model->getAsArray(Large::class));
    }


    /**
     * @OA\Get(
     *     path="/ordinary-load/count",
     *     tags={"ordinary-load"},
     *     operationId="getCountOrdinary",
     *     summary="getCountOrdinary",
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
     *                          example=" 0 -> STATUS_DELETED,1 -> STATUS_ACTIVE,   2 -> STATUS_INACTIVE"
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
        $user = OrdinaryLoad::find()
            ->select(['status','COUNT(status) as number'])
            ->where([
                'status' => [
                    LoadStatus::CANCELLED,
                    LoadStatus::IN_PROGRESS,
                    LoadStatus::PENDING,
                    LoadStatus::COMPLETED,
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
     *     path="/ordinary-load",
     *     tags={"ordinary-load"},
     *     operationId="getOrdinaryLoad",
     *     summary="getOrdinaryLoad",
     *    @OA\Parameter(
     *         name="SearchLoadOrdinary[id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="SearchLoadOrdinary[port_id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchLoadOrdinary[destination_id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *    @OA\Parameter(
     *         name="SearchLoadOrdinary[load_id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *    @OA\Parameter(
     *         name="SearchLoadOrdinary[customer_id]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *    @OA\Parameter(
     *         name="SearchLoadOrdinary[status][]",
     *         in="query",
     *         required=false,
     *         description="pending, in_progress, completed,cancelled,archived",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                  type="string"
     *             ),
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="SearchLoadOrdinary[equipmentNeed][]",
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
     *         name="SearchLoadOrdinary[pick_up_date_from]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="date",
     *              pattern="^([0-9]{4})-(?:[0-9]{2})-([0-9]{2})$"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchLoadOrdinary[pick_up_date_to]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="date",
     *              pattern="^([0-9]{4})-(?:[0-9]{2})-([0-9]{2})$"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="SearchLoadOrdinary[pallets]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
     *         )
     *     ),
     *       @OA\Parameter(
     *          name="SearchLoadOrdinary[pallet_size]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="string",
     *              enum={"48x40","42x42","48x48"}
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="SearchLoadOrdinary[weight_LBs]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *              type="integer",
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
     *                 @OA\Items(ref="#/components/schemas/OrdinaryLoadSmall")
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

    public function actionIndex($page = 0, $page_size = 10)
    {
        $SearchLoadOrdinary = new SearchLoadOrdinary();
        $SearchLoadOrdinary->load(\Yii::$app->request->queryParams);
        if ( $SearchLoadOrdinary->validate()) {
            $query =  $SearchLoadOrdinary->search();
        } else {
            throw new HttpException(400, ['SearchLoadOrdinary' => $SearchLoadOrdinary->getErrors()]);
        }
        return $this->index($query, $page, $page_size, Small::class);

    }

    /**
     * @OA\Patch (
     *     path="/ordinary-load/status/{id}",
     *     tags={"ordinary-load"},
     *     operationId="changeOrdinaryLoadId",
     *     summary="changeOrdinaryLoadId",
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
     *                      enum={"pending","in_progress", "completed","cancelled"}
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
        $model = OrdinaryLoad::findOne($condition);
        if ($model) {
            $model->load(\Yii::$app->getRequest()->post(), 'UpdateStatusForm') && $model->validate();
            $model->save();
        }
        return $this->success($model);
    }

    /**
     * @OA\Delete(
     *     path="/ordinary-load/{id}",
     *     tags={"ordinary-load"},
     *     operationId="deleteOrdinaryLoad",
     *     summary="deleteOrdinaryLoad",
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
     * @throws StaleObjectException
     */

    public function actionDelete($id): array
    {
        $model = $this->findModel($id);
        $model->status = LoadStatus::ARCHIVED;
        $model->update();
        return $this->success($model->getAsArray(Large::class));
    }

    private function findModel($id): OrdinaryLoad
    {
        $con = ['id' => $id];
        $model = OrdinaryLoad::findOne($con);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $model;
    }

}
