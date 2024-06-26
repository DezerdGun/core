<?php

namespace api\controllers;

use common\models\LoadStatus;

class LoadStatusController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/lists/load-status",
     *     tags={"lists"},
     *     operationId="getLoadStatus",
     *     summary="getLoadStatus",
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
        $status = LoadStatus::find()->all();
        return $this->success($status);
    }
}