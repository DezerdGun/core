<?php

namespace api\controllers;

use common\models\Load_modes;

class LoadModesController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/lists/load-modes",
     *     tags={"lists"},
     *     operationId="getLoadModes",
     *     summary="getLoadModes",
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
        $loadmodes = Load_modes::find()->all();
        return $this->success($loadmodes);
    }
}