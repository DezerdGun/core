<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\user\Large;
use api\templates\user\Small;
use common\models\Broker;
use common\models\User;
use OpenApi\Annotations as OA;
use yii\web\NotFoundHttpException;

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

    public $new_password;

    public function actionUpdate($verification_token)
    {
        $profil = $this->findModel($verification_token);
        if( $profil){
            $profil->load(\Yii::$app->getRequest()->post(), 'Profile');
            $profil->setPassword($this->new_password);
            $profil->generateAuthKey();
            $profil->verification_token = null;
            $profil->role = $profil::SUB_BROKER;
            $profil->status = $profil::STATUS_ACTIVE;
            $profil->update();
        }else{
            throw new HttpException(404, \Yii::t('app', 'You Missed Something'));
        }
        return $this->success($profil->getAsArray(Large::class));
    }

    private function findModel($verification_token)
    {
        $condition = ['verification_token' => $verification_token];
        $model = User::findOne($condition);
        if (!$model) {
            throw new NotFoundHttpException('Token is expired');
        }
        return $model;
    }

    /**
     * @OA\Delete(
     *     path="/profile/{user_id}/and/{master_id}",
     *     tags={"invite-broker"},
     *     operationId="deleteSubBrokerDelete",
     *     summary="deleteSubBroker Delete -> soft delete SubBroker",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         description="user_id -> это id SubBroker"
     *     ),
     *     @OA\Parameter(
     *         name="master_id",
     *         in="path",
     *         required=true,
     *         description="master_id -> это создатель SubBroker"
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
     *          @OA\Property(
     *              property="Broker[master_id]",
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
     */

    public function actionBrokerDelete($user_id, $master_id)
    {
        $model = Broker::findOne(['user_id' => $user_id]);
        $con = Broker::findOne(['master_id' => $master_id]);
        if (!$con && !$model || !$con && $model || $con && !$model ) {
            throw new HttpException(404, \Yii::t('app', 'MasterId или UserId не найден!'));
        } else {
            $user = User::findOne(['id' => $model->user_id]);
            $user->status = $user::STATUS_INACTIVE;
            $user->role = $user::STATUS_EMPTY;
            $user->update();
            throw new HttpException(200, \Yii::t('app', "User was Disactived"));
        }
    }


}