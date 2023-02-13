<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\user\Large;
use common\models\Broker;
use common\models\User;
use yii\db\StaleObjectException;


class ProfileController extends BaseController
{

    /**
     * @OA\PATCH (
     *     path="/profile/{verification_token}",
     *     tags={"invite-broker"},
     *     operationId="patchCreateProfileInformation",
     *     summary="patchCreateProfileInformation -> Broker sign up ",
     *     @OA\Parameter(
     *         in="path",
     *         name="verification_token",
     *         required=true,
     *         @OA\Schema(
     *          type="string"
     *          )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  @OA\Property(
     *                      property="Profile[name]",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="Profile[email]",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="Profile[mobile_number]",
     *                      type="string",
     *                  ),
     *                  @OA\Property(
     *                      property="Profile[password_hash]",
     *                      type="string",
     *                  ),
     *            )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successfull operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="status",
     *                  type="string",
     *                  example="success"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *              )
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     */



    public function actionUpdate($verification_token)
    {
        $condition = ['verification_token' => $verification_token];
        $model = User::findOne($condition);
        if ($condition){
            $model->load(\Yii::$app->getRequest()->post(), 'Profile') && $model->validate();
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
            $model->verification_token = null;
            $model->role = $model::SUB_BROKER;
            $model->status = $model::STATUS_ACTIVE;
            if (!$model->validate()){
                throw new HttpException(400, \Yii::t('app', 'This email mobile_number name has already been verified.'));
            }
            $model->save();
        }
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Delete(
     *     path="/profile/{user_id}",
     *     tags={"invite-broker"},
     *     operationId="deleteSubBrokerDelete",
     *     summary="deleteSubBroker Delete -> soft delete SubBroker",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="user_id -> это id SubBroker"
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
     *              property="Broker[user_id]",
     *              type="integer",
     *              ),
     *             ),
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     * @throws StaleObjectException|HttpException
     */

    public function actionBrokerDelete($user_id)
    {
        $model = Broker::findOne(['user_id' => $user_id]);
        if (!$model) {
            throw new HttpException(404, \Yii::t('app', 'UserId не найден!'));
        } else {
            $user = User::findOne(['id' => $model->user_id]);
                $user->status = user::STATUS_DELETED;
                $user->update();
            throw new HttpException(200, \Yii::t('app', "User was Disactived"));
        }
    }


}