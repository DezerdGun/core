<?php

namespace api\controllers;

use common\models\Truck;

class TruckController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/lists/truck",
     *     tags={"lists"},
     *     operationId="getTruck",
     *     summary="getTruck",
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
        $truck = Truck::find()->all();
        return $this->success($truck);
    }

}
