<?php

namespace api\controllers;

use common\enums\LoadStatus;
use common\models\User;

class CountBrokerController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/count-broker/count",
     *     tags={"invite-broker"},
     *     operationId="getCountBroker",
     *     summary="getCountBroker",
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
     *                         type="string",
     *                          example=" 0 -> STATUS_DELETED,1 -> STATUS_ACTIVE,   2 -> STATUS_INACTIVE"
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

    public function actionActive(): array
    {
        $user = User::find()
            ->select(['status','COUNT(status) as number'])
            ->where([
                'role' => [
                    User::MASTER_BROKER,
                    User::SUB_BROKER,
                    User::STATUS_NULL,
                ],
                'status' => [
                    User::STATUS_ACTIVE,
                    User::STATUS_INACTIVE,
                    User::STATUS_DELETED,

                ],
            ])
            ->groupBy(['status'])
            ->asArray()
            ->all();
        return $this->success($user);
    }
}