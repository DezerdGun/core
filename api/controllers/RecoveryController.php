<?php

namespace api\controllers;

use api\forms\UserCreate;
use common\models\User;
use Yii;

/**
* This is the class for controller "RecoveryController".
*/
class RecoveryController extends BaseController
{
    private $email;

    /**
     * @OA\POST(
     *     path="/user/recovery",
     *     tags={"Forgot/RecoveryPassword"},
     *     operationId="reset",
     *     summary="resetPassword",
     *     @OA\Parameter(
     *         name="email",
     *         required=false,
     *         in="query",
     *     ),
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

    public function actionRecovery($email)
    {
        $user = User::find()->where(['email' => $email])->one();
        $user->updateAttributes(['status' => User::STATUS_INACTIVE]);
        $user->updateAttributes(['confirm_code' => User::STATUS_EMPTY]);
        if($user == TRUE ){
            $user->confirm_code = mt_rand(1000,9999);
            $user->save();
            if($this->sendEmail($user) == TRUE)
                {
                    echo 'We sent to code Please Confirm it!!!';
                }else{
                    echo 'We cannot find your Email! Please Check one more Time!)';
                }
        }else{
            echo 'Something gone wrong!!!';
        }
    }

    public function sendEmail($user)
    {
        // find all active subscribers
        return  Yii::$app->mailer->compose(
            ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
            ['user' => $user]
        )
        ->setTo($user->email)
        ->setFrom([Yii::$app->params['supportEmail'] => 'TMS 2'])
        ->setSubject($user->confirm_code)
        ->setTextBody('111')
        ->send();
    }

    /**
     * @OA\Post(
     *      path="/user/{confirm_code}/password",
     *     tags={"Forgot/RecoveryPassword"},
     *     operationId="confirmUser",
     *     summary="confirmUser",
     *     @OA\Parameter(
     *         name="confirm_code",
     *         in="path",
     *         required=true
     *     ),
     *    @OA\Parameter(
     *         name="password",
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


    public function actionPassword($confirm_code)
    {
        $code = User::find()->where(['confirm_code'=>$confirm_code])->one();
        if($code == TRUE){
            $code->status = '1';
            $code->password = md5($_POST['password']);
            $code->save();
            echo 'Successful You made new Password!!!';
        }else{
            echo 'Please Check again!';
        }
    }

}
