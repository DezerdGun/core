<?php

namespace api\controllers;

use api\components\HttpException;
use api\components\sms\SMSRequest;
use api\forms\user\UserCheckForm;
use api\forms\user\UserConfirmEmailForm;
use api\forms\user\UserResendForm;
use api\forms\user\UserCreateForm;
use api\templates\user\Small;
use common\models\User;
use Yii;

class UserController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/user",
     *     tags={"user"},
     *     operationId="User",
     *     summary="createUser",
     *     requestBody={"$ref":"#/components/requestBodies/UserCreateForm"},
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
     *             )
     *         )
     *     ),
     *     security={
     *     {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionCreate()
    {
       $model = new UserCreateForm();
       $user = new User();
       if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           $model->signup($user);
       } else {
           throw new HttpException(400, [$model->formName() => $model->getErrors()]);
       }
       return $this->success($user->getAsArray(Small::class));
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

    public function actionCheck()
    {
        $model = new UserCheckForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status();
        }  else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $this->success('Thank For your Registration');
    }
}
