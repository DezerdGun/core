<?php

namespace api\controllers;

use api\components\HttpException;
use api\forms\user\UserCheckForm;
use api\forms\user\UserNewPasswordForm;
use api\forms\user\UserRecoveryForm;
use api\forms\user\UserResendForm;
use api\forms\user\UserCreateForm;
use api\khalsa\services\UserService;
use api\templates\user\Large;
use api\templates\user\Small;
use common\models\User;
use Yii;
use yii\web\NotFoundHttpException;

class UserController extends BaseController
{
    public $userService;
    public function __construct
    (
        $id,
        $module,
        $config = [],
        UserService $userService
    )
    {
        parent::__construct($id, $module, $config);
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *     path="/user/resend",
     *     tags={"user"},
     *     operationId="resendConfirmationCode",
     *     summary="resendConfirmationCode",
     *     requestBody={"$ref":"#/components/requestBodies/UserResendForm"},
     *     description="This endpoint can be used to resend confirm code",
     *       @OA\Response(
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
     *                 type="object",
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionResend()
    {
        $model = new UserResendForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           $model->resend();
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $this->success();
    }

    /**
     * @OA\Post(
     *     path="/user/check",
     *     tags={"user"},
     *     operationId="checkUser",
     *     summary="checkUser",
     *     requestBody={"$ref":"#/components/requestBodies/UserCheckForm"},
     *     description="Checks user's verifaction code. If code is right user status becomes active",
     *       @OA\Response(
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
     *                 type="object",
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionCheck(): array
    {
        $model = new UserCheckForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status();
        }  else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $this->success();
    }

    /**
     * @OA\POST(
     *     path="/user/recovery",
     *     tags={"Forgot/RecoveryPassword"},
     *     operationId="reset",
     *     summary="resetPassword",
     *     requestBody={"$ref":"#/components/requestBodies/UserRecoveryForm"},
     *     description="Send recovery code to user, If you forgot password.",
     *     @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success",
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionRecovery(): array
    {
        $model = new UserRecoveryForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->recovery();
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $this->success('Verification code sent to your email.');
    }

    /**
     * @OA\POST(
     *     path="/user/password",
     *     tags={"Forgot/RecoveryPassword"},
     *     operationId="setNewPassword",
     *     summary="setNewPassword",
     *     requestBody={"$ref":"#/components/requestBodies/UserNewPasswordForm"},
     *     @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionPassword(): array
    {
        $model = new UserNewPasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->newPassword();
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $this->success('Success');

    }

    /**
     * @OA\Get(
     *     path="/user/{id}",
     *     tags={"user"},
     *     operationId="getUserById",
     *     summary="getUserById",
     *     description="This endpoint can be used to get by ID some of information users",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true
     *     ),
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
     *                 type="object",
     *                 ref="#/components/schemas/UserLarge"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *
     *     }
     * )
     */

    public function actionGet($id)
    {
        $model = $this->findModel($id);
        return $this->success($model->getAsArray(Large::class));
    }



    private function findModel($id)
    {
        $condition = ['id' => $id];
        $model = User::findOne($condition);
        if (!$model){
            throw new NotFoundHttpException();
        }
        return $model;
    }


    /**
     * @OA\Get(
     *     path="/user",
     *     tags={"user"},
     *     operationId="getMe",
     *     summary="/getMe",
     *       @OA\Response(
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
     *                 type="object",
     *                 ref="#/components/schemas/UserSmall"
     *             ),
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *
     *     }
     * )
     */

    function actionMe(): array
    {
        $id = yii::$app->user->id;
        $model = User::findOne(['id' => $id]);

        return $this->success($model->getAsArray(Small::class));
    }
    /**
     * @OA\Patch (
     *     path="/user/photo",
     *     tags={"user"},
     *     operationId="uploadPhoto",
     *     summary="updatePhoto",
     *     @OA\RequestBody(
     *          request="ListingContainerForm",
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="User[user_picture]",
     *                      type="string",
     *                      format="binary"
     *                  ),
     *                  required={
     *                      "User[user_picture]",
     *                  }
     *              )
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
     *              )
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     */
    public function actionUploadPhoto()
    {
        $this->userService->uploadPhoto();
        return $this->success();
    }
    /**
     * @OA\Delete(
     *     path="/user/photo",
     *     tags={"user"},
     *     operationId="deleteUserPhoto",
     *     summary="deleteUserPhoto",
     *     @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionDeletePhoto(): array
    {
        $this->userService->deletePhoto();
        return $this->success();
    }

    /**
     * @OA\Patch (
     *     path="/user/password/change",
     *     tags={"user"},
     *     operationId="changePassword",
     *     summary="changePassword",
     *     @OA\RequestBody(
     *          request="UserChangePassword",
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property (
     *                      property="old_password",
     *                      type="string"
     *                  ),
     *                  @OA\Property (
     *                      property="new_password",
     *                      type="string"
     *                  ),
     *                  required={
     *                      "old_password",
     *                      "new_password"
     *                  }
     *              )
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
     *              )
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     */
    public function actionChangePassword(): array
    {
        $this->userService->changePassword();
        return $this->success();
    }

}
