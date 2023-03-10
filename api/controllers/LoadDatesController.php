<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\LoadDatesService;
use api\templates\Date\Large;
use common\models\Date;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

class LoadDatesController extends BaseController
{
    public $loadDatesService;

    public function __construct($id, $module, $config = [],
                                LoadDatesService $loadDatesService
    )
    {
        parent::__construct($id, $module, $config);
        $this->loadDatesService = $loadDatesService;

    }
    /**
     * @OA\Patch (
     *     path="/load-dates/{id}",
     *     tags={"load-dates"},
     *     operationId="updateLoadDates",
     *     summary="updateLoadDates",
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
     *                     property="vessel_eta",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="last_free_day",
     *                     type="date",
     *                     format="date-time",
     *                     pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *                     example="12-12-2021 21:39:00",
     *                     description="12-12-2021 21:39:00"
     *              ),
     *                 @OA\Property(
     *                     property="discharged_date",
     *                     type="date",
     *                     format="date-time",
     *                     pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *                     example="12-12-2021 21:39:00",
     *                     description="12-12-2021 06:39:00"
     *              ),
     *                  @OA\Property(
     *                     property="outgate_date",
     *                     type="date",
     *                     format="date-time",
     *                     pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *                     example="12-12-2021 21:39:00",
     *                     description="12-12-2021 06:39:00"
     *              ),
     *                  @OA\Property(
     *                     property="empty_date",
     *                     type="date",
     *                     format="date-time",
     *                     pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *                     example="12-12-2021 21:39:00",
     *                     description="12-12-2021 06:39:00"
     *              ),
     *                   @OA\Property(
     *                     property="ingate_ate",
     *                     type="date",
     *                     format="date-time",
     *                     pattern="/([0-9]{4})-(?:[0-9]{2})-([0-9]{2})/",
     *                     example="12-12-2021 21:39:00",
     *                     description="12-12-2021 06:39:00"
     *              ),
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

        $this->loadDatesService->update($id);
        return $this->success();
    }

    /**
     * @OA\Delete(
     *     path="/load-dates/{id}",
     *     tags={"load-dates"},
     *     operationId="deleteLoadDates",
     *     summary="deleteLoadDates",
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
     * @throws StaleObjectException
     */

    public function actionDelete($id): array
    {
        $this->loadDatesService->delete($id);
        return $this->success();
    }

    /**
     * @OA\Get(
     *     path="/load-dates",
     *     tags={"load-dates"},
     *     operationId="getLoadDates",
     *     summary="getLoadDates",
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
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="vessel_eta",
     *                         type="date"
     *                     ),
     *                     @OA\Property(
     *                         property="last_free_day",
     *                         type="date"
     *                     ),
     *                     @OA\Property(
     *                         property="discharged_date",
     *                         type="date"
     *                     ),
     *                      @OA\Property(
     *                         property="outgate_date",
     *                         type="date"
     *                     ),
     *                     @OA\Property(
     *                         property="empty_date",
     *                         type="date"
     *                     ),
     *                    @OA\Property(
     *                         property="ingate_ate",
     *                         type="date"
     *                     ),
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
    public function actionIndex(): array
    {
        $equipment = Date::find()
            ->select('id,vessel_eta,last_free_day,discharged_date,outgate_date,empty_date,ingate_ate')
            ->all();
        return $this->success($equipment);
    }

    /**
     * @OA\Get(
     *     path="/load-dates/{id}",
     *     tags={"load-dates"},
     *     operationId="getLoadDatesId",
     *     summary="getLoadDatesId",
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
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="id",
     *                         type="string"
     *                     ),
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
    public function actionShow($id)
    {
        $model = $this->list($id);
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @throws NotFoundHttpException
     */
    private function list($id)
    {
        $con = ['id' => $id];
        $model = Date::findOne($con);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $model;
    }
}