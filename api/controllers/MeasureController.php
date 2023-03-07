<?php

namespace api\controllers;

use common\models\Measure;

class MeasureController extends \api\controllers\BaseController
{
    /**
     * @OA\Get(
     *     path="/lists/measure",
     *     tags={"lists"},
     *     operationId="getMeasure",
     *     summary="getMeasure",
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
     *                         property="name",
     *                         type="string"
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
    public function actionIndex()
    {
        $model = Measure::find()->all();
        return $this->success($model);
    }

}
