<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\ordinaryload\Large;
use common\models\OrdinaryLoad;
use common\models\OrdinaryNeeded;

class OrdinaryLoadController extends BaseController
{

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
     *              property="OrdinaryLoad[origin]",
     *              type="integer",
     *              format="Number{ForeignKey}",
     *              example="1",
     *              description="Origin[ForeignKey]TO[Location]"
     *              ),
     *          @OA\Property(
     *              property="OrdinaryLoad[destination]",
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
     */
    public function actionCreate()
    {
        $model = new OrdinaryNeeded();
        if ($model->load(\Yii::$app->request->post())  && $model->save()) {
            $model = new OrdinaryLoad(['equipment_need' => $model->id]);
            if ($model->load(\Yii::$app->request->post())  && $model->save()) {
                return $this->success($model->getAsArray(Large::class));
            } else {
                throw new HttpException(400,
                    [$model->formName() => $model->getErrors()]);
            }
        } else {
            throw new HttpException(400,
                [$model->formName() => $model->getErrors()]);
        }
    }

}
