<?php

namespace api\controllers;

use common\models\State;

/**
* This is the class for controller "ListstateController".
*/
class StateController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/lists/state",
     *     tags={"lists"},
     *     operationId="getStates",
     *     summary="getStates",
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
        $data = State::find()->all();
        return $this->success($data);
    }

}
