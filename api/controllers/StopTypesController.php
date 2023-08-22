<?php

namespace api\controllers;

use api\templates\loadstop\Small;
use common\models\LoadStop;

class StopTypesController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/lists/stop-types",
     *     tags={"lists"},
     *     operationId="getStoptypes",
     *     summary="getStoptypes",
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

    public function actionIndex($query = '', $page = 0, $pageSize = 25)
    {
        return $this->index(LoadStop::find()->andWhere(['ILIKE', 'stop_type', $query]),
            $page, $pageSize, Small::class);
    }
}