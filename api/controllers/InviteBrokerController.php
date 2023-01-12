<?php

namespace api\controllers;

use api\components\HttpException;
use api\forms\user\UserCreateForm;
use common\models\Broker;
use common\models\User;
use OpenApi\Annotations as OA;


class InviteBrokerController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/invite-broker/{email}",
     *     tags={"invite-broker"},
     *     operationId="createInviteBroker",
     *     summary="createInviteBroker",
     *     @OA\Parameter(
     *         name="email",
     *         in="path",
     *         required=true
     *     ),
     *       @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             ),
     *          @OA\Property(
     *                 property="data",
     *                 type="object",
     *          @OA\Property(
     *              property="InviteBroker[email]",
     *              type="string",
     *              ),
     *             ),
     *         )
     *     ),
     *     security={
     *     {"ClientCredentials":{}}
     *     }
     * )
     * @throws HttpException
     * @throws \yii\db\StaleObjectException
     */

    public function actionInvite($email)
    {
        $user = User::findOne(['email' => $email]);
        $masterBroker = new Broker();
        if ($user) {
            $email = new UserCreateForm();
            $email->brokerEmail($user);
            $user->update();
            $masterBroker->user_id = $user->id;
            $masterBroker->master_id =\Yii::$app->user->id;
            $masterBroker->save();
            return $this->success();
        } else {
            throw new HttpException(404, \Yii::t('app', 'ID не найден!'));
        }
    }


}