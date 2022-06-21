<?php

namespace api\controllers;

use common\models\TruckTypes;

class TruckTypesController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/lists/truck-types",
     *     tags={"lists"},
     *     operationId="getTruckTypes",
     *     summary="getTruckTypes",
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
        $item = TruckTypes::find()->all();
        return $this->success($item);
    }
}