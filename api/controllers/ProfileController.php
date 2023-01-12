<?php

namespace api\controllers;

use api\components\HttpException;
use common\models\User;
use OpenApi\Annotations as OA;
use yii\web\NotFoundHttpException;

class ProfileController extends BaseController
{
    /**
     * @OA\PATCH (
     *     path="/profile/{verification_token}",
     *     tags={"profile"},
     *     operationId="patchCreateProfileInformation",
     *     summary="patchCreateProfileInformation",
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
            $profil->role = 'Sub broker';
            $profil->status = 1;
            $this->saveModel($profil);
        }else{
            throw new HttpException(404, \Yii::t('app', 'else working'));
        }
        return $this->success();
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

}