<?php

namespace api\controllers;

use api\components\HttpException;
use api\components\sms\SMSRequest;
use api\forms\user\UserCheckForm;
use api\forms\user\UserVerifyForm;
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
       $createForm = new UserCreateForm();
       $model = new User();
       if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
           $createForm->signup($model);
       } else {
           throw new HttpException(400, [$createForm->formName() => $createForm->getErrors()]);
       }
       return $this->success($model->getAsArray(Small::class));
    }

    /**
     * @OA\Post(
     *      path="/user/{confirm_code}/suspect",
     *     tags={"user"},
     *     operationId="confirmUser",
     *     summary="confirmUser",
     *     @OA\Parameter(
     *         name="confirm_code",
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
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     */


    public function actionSuspect($confirm_code)
    {
        $code = User::find()->where(['confirm_code'=>$confirm_code])->one();
        if($code == TRUE){
            $code->status = '1';
            $code->save();
            echo 'Status updated successful';
//            User::updateAll(['status'=>User::STATUS_ACTIVE]);
        }else {
            throw new HttpException(400,['wrong']);
        }
    }
    /**
     * @OA\Post(
     *     path="/user/verify",
     *     tags={"user"},
     *     operationId="verifyUser",
     *     summary="verifyUser",
     *     requestBody={"$ref":"#/components/requestBodies/UserVerifyForm"},
     *     description="Verify user's phone number. This endpoint can be used to resend confirm code",
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

    public function actionVerify()
    {
        $model = new UserVerifyForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $smsRequest = new SMSRequest();
            $smsRequest->verify($model->mobile_number);
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
     *     description="Check user's mobile number. If code is right status becomes active",
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
            $smsRequest = new SMSRequest();
            $response = $smsRequest->verifyCheck($model);
            if ($response['status'] == SMSRequest::STATUS_SUCCESS)
                $model->status();
            else {
                throw new HttpException(400, [$model->formName() => $model->getErrors()]);
            }
        }  else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $this->success();
    }
}
