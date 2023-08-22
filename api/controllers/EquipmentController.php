<?php

namespace api\controllers;

use common\models\Equipment;

class EquipmentController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/lists/equipment",
     *     tags={"lists"},
     *     operationId="getEquipment",
     *     summary="getEquipment",
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
        $equipment = Equipment::find()->all();
        return $this->success($equipment);
    }
}