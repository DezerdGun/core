<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\ordinaryload\Large;
use common\models\Load;
use common\models\OrdinaryLoad;
use common\models\OrdinaryNeeded;
use common\models\User;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;
use yii\web\NotFoundHttpException;

class OrdinaryLoadController extends BaseController
{

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
     *                  property="OrdinaryNeeded[ordinary_need]",
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
     */

    public function actionCreate(): array
    {
        $model = new OrdinaryNeeded();
        if ($model->load(\Yii::$app->request->post())  && $model->save() && $model->validate()) {
            $model = new OrdinaryLoad(['equipment_need_id' => $model->id]);
            $model->user_id = \Yii::$app->user->id;
            if ($model->load(\Yii::$app->request->post()) && $model->validate()  ) {
                $model->status = OrdinaryLoad::PENDING;
                $model->save();
                return $this->success($model->getAsArray(Large::class));
            } else {
                throw new HttpException(400, [$model->formName() => $model->getErrors()]);
            }
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
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
                'status' => [OrdinaryLoad::CANCELLED,OrdinaryLoad::IN_PROGRESS,OrdinaryLoad::PENDING,OrdinaryLoad::COMPLETED],
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
     *     operationId="getOrdinaryLoads",
     *     summary="getOrdinaryLoads",
     *     @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 type="string",
     *                 example="success"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="string",
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
        $query = OrdinaryLoad::find();
        return $this->index($query, $page, $pageSize,Large::class );

    }




}
