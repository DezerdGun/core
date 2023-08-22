<?php

namespace api\controllers;

use common\models\Container;


/**
* This is the class for controller "ContainerController".
*/
class ContainerController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/lists/container",
     *     tags={"lists"},
     *     operationId="getContainerTypes",
     *     summary="getContainerTypes",
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
        $data = Container::find()->all();
        return $this->success($data);
    }
}
