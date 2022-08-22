<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\load\Large;
use api\templates\load\Small;
use Codeception\PHPUnit\Constraint\JsonType;
use common\models\Load;
use common\models\LoadStop;
use common\models\traits\Template;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;


class LoadController extends BaseController
{

    /**
     * @OA\Get(
     *     path="/load",
     *     tags={"load"},
     *     operationId="getLoad",
     *     summary="getLoad",
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

    public function actionIndex($query = '', $page = 0, $pageSize = 25)
    {
        return $this->index(Load::find()->andWhere(['ILIKE', 'load_type', $query]),
            $page, $pageSize, Large::class);
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
     *              property="Load[consignTruckee_id]",
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
        if ($model->load( \Yii::$app->request->post() ) &&  $model->validate() && $model->save()) {
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

    public function actionDelete($id) {
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
