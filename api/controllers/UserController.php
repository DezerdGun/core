<?php

namespace api\controllers;

use api\forms\UserCreate;
use common\models\User;

/**
 * This is the class for controller "UserController".
 *
 * @OA\Schema(
 *     required={"username","email"}
 * )
 */
class UserController extends BaseController
{


    /**
     * @OA\Post(
     *     path="/user",
     *     tags={"user"},
     *     operationId="User",
     *     summary="User",
     *   @OA\RequestBody(
     *       description="UserCreate",
     *   @OA\JsonContent(ref="#/components/schemas/UserCreate"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               type="object",
     *               ref="#/components/schemas/UserCreate"
     *          ),
     *       )
     *   ),
     *       @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             ),
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */

    public function actionCreate()
    {
       $model = new UserCreate();
       $model->username = $_POST['username'];
       $model->email = $_POST['email'];
       $model->password = md5($_POST['password']);
       $model->confirm_code = mt_rand(1000,9999);
       if($model == TRUE){
           $model->signup();
           return $model;
       }else{
           echo 'error';
       }
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
        }else{
            echo 'wrong';
        }
    }

}
