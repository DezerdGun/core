<?php

namespace api\controllers;

use api\components\HttpException;
use api\forms\user\UserCreateForm;
use api\templates\broker\Large;
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

    /**
     * @OA\Get(
     *     path="/invite-broker/active",
     *     tags={"invite-broker"},
     *     operationId="getActiveBroker",
     *     summary="getActiveBroker",
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
     *                         type="string"
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
    public function actionIndex()
    {
        $data = User::find()
            ->where(['status' => 1])
            ->all();
        $rows = (new \yii\db\Query())
            ->select(['id','username','name','mobile_number','name','email','role'])
            ->from('user')
            ->where(['id' => $data])
            ->all();
        if ($rows){
            return $this->success($rows);
        }else{
            throw new HttpException(400, \Yii::t('app', "Users are absented"));
        }
    }

    /**
     * @OA\Get(
     *     path="/invite-broker/pending",
     *     tags={"invite-broker"},
     *     operationId="getPendingBroker",
     *     summary="getPendingBroker",
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
     *                         type="string"
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
    public function actionPending()
    {
        $data = User::find()
            ->where(['status' => 2])
            ->all();
        $rows = (new \yii\db\Query())
            ->select(['id','username','name','mobile_number','name','email','role'])
            ->from('user')
            ->where(['id' => $data])
            ->all();
        if ($rows){
            return $this->success($rows);
        }else{
            throw new HttpException(400, \Yii::t('app', "Users are absented"));
        }
    }

    /**
     * @OA\Get(
     *     path="/invite-broker/{name}/or/{email}",
     *     tags={"invite-broker"},
     *     operationId="getInviteBrokerNameAndEmail",
     *     summary="getInviteBrokerSearch",
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="path",
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
     *              property="InviteBroker[name]",
     *              type="object",
     *              ),
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

    public function actionShow($name, $email)
    {
        if($name){
            $data = User::find()
                ->where(['name' => $name])
                ->all();
            $rows = (new \yii\db\Query())
                ->select(['id','username','name','email','role'])
                ->from('user')
                ->where(['id' => $data])
                ->all();
            return  $this->success($rows);
        }else {
            $data = User::findOne(['email' => $email]);
            return  $this->success($data);
        }
    }

    /**
     * @OA\Get(
     *     path="/invite-broker/disabled",
     *     tags={"invite-broker"},
     *     operationId="getDisabledBroker",
     *     summary="getDisabledBroker",
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
     *                         type="string"
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
    public function actionDisabled()
    {
        $data = User::find()
            ->where(['status' => 2,'role' => null])
            ->all();
        $rows = (new \yii\db\Query())
            ->select(['id','username','name','mobile_number','name','email','role'])
            ->from('user')
            ->where(['id' => $data])
            ->all();
        if ($rows){
            return $this->success($rows);
        }else{
            throw new HttpException(400, \Yii::t('app', "Users are absented"));
        }


    }
}