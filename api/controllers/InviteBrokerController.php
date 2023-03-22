<?php

namespace api\controllers;

use api\components\HttpException;
use api\forms\broker\BrokerCreate;
use api\forms\user\UserCreateForm;
use api\templates\broker\Large;
use api\templates\user\Inviter;
use api\templates\user\Small;
use common\models\Broker;
use common\models\Customer;
use common\models\User;
use OpenApi\Annotations as OA;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;


class InviteBrokerController extends BaseController
{


    /**
     * @OA\Post(
     *     path="/invite-broker",
     *     tags={"invite-broker"},
     *     operationId="createInviteBroker",
     *     summary="createInviteBroker",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="InviteBroker",
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *             )
     *         )
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
     */

    public function actionInvite()
    {
        $user = new User();
        $masterBroker = new Broker();
        if ($user) {
            $user->load($this->getAllowedPost(), 'InviteBroker');
            $user->password_hash = $user::STATUS_EMPTY;
            $user->status = $user::STATUS_EMPTY;
            $email = new UserCreateForm();
            $email->brokerEmail($user);
            $this->saveModel($user);
            $masterBroker->user_id = $user->id;
            $masterBroker->master_id =\Yii::$app->user->id;
            $masterBroker->save();
            return $this->success($user->getAsArray(\api\templates\user\Large::class));
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
            ->where([
                'role' => [User::MASTER_BROKER,User::SUB_BROKER],
                'status' => User::STATUS_ACTIVE
            ])
            ->all();
        $rows = (new \yii\db\Query())
            ->select(['id','name','mobile_number','email','role'])
            ->from('user')
            ->where(['id' => $data])
            ->all();
        return $this->success($rows);
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
    public function actionPending(): array
    {
        $data = User::find()
            ->where([
                'role' => [User::STATUS_NULL],
                'status' => User::STATUS_INACTIVE
            ])
            ->all();
        $rows = (new \yii\db\Query())
            ->select(['id','name','mobile_number','email','role'])
            ->from('user')
            ->where(['id' => $data])
            ->all();
        return $this->success($rows);
    }

    /**
     * @OA\Get(
     *     path="/invite-broker",
     *     tags={"invite-broker"},
     *     operationId="getInviteBrokerNameAndEmail",
     *     summary="getInviteBrokerSearch",
     *        @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=false,
     *         description="{Swagger} or {swagger@jafton.com}",
     *         example="swagger@jafton.com",
     *         @OA\Schema(
     *             type="string"
     *         ),
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
     *              property="InviteBroker[name][email]",
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

    public function actionShow($name): array
    {
            $command = User::find()
                ->select(['id','name', 'email','mobile_number','role'])
                ->filterWhere(['LIKE', 'username', "$name"])
                ->orfilterWhere(['LIKE', 'email', "$name"])
                ->orfilterWhere(['LIKE', 'name', "$name"])
                ->all();
        return $this->success($command);

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
     *                         type="string",
     *                         example =" 0 -> STATUS_DELETED,1 -> STATUS_ACTIVE,   2 -> STATUS_INACTIVE"
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

            ->where([
                'role' => [User::MASTER_BROKER,User::SUB_BROKER],
                'status' => User::STATUS_DELETED
            ])
            ->all();
        $rows = (new \yii\db\Query())
            ->select(['id','username','name','mobile_number','name','email','role'])
            ->from('user')
            ->where(['id' => $data])
            ->all();
        return $this->success($rows);
    }


    /**
     * @OA\Patch(
     *     path="/invite-broker/{id}",
     *     tags={"invite-broker"},
     *     operationId="restoreSubBroker",
     *     summary="restoreSubBroker -> restore SubBroker",
     *     @OA\Parameter(
     *         name="id",
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
     *              property="InviteBroker[id]",
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


    public function actionRestore($id)
    {
        $user = User::findOne(['id' => $id]);
        $masterBroker = new Broker();
        if ($user) {
            $user->role = $user::SUB_BROKER;
            $user->status = $user::STATUS_ACTIVE;
            $user->update();
            $masterBroker->user_id = $user->id;
            $masterBroker->master_id =\Yii::$app->user->id;
            $masterBroker->save();
            return $this->success();
        } else {
            throw new HttpException(404, \Yii::t('app', 'Email не найден!'));
        }
    }

    /**
     * Update
     * @OA\Put  (
     *     path="/invite-broker/{user_id}",
     *     tags={"invite-broker"},
     *     operationId="updateChangeSubBrokerRole",
     *     summary="update Change SubBroker And MasterBroker Role",
     *      @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         example="34",
     *         description="user_id -> это id SubBroker",
     *        @OA\Schema(
     *          type="string"
     *          )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *              @OA\Property(
     *                      property="User[role]",
     *                      type="string",
     *                      enum={"Sub broker","Master broker"},
     *                  ),
     *            )
     *         )
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
     *              property="InviteBroker[role]",
     *              type="string",
     *              ),
     *             ),
     *         )
     *     ),
     *      security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *
     *     }
     *  )
     * @throws StaleObjectException|HttpException
     */


    public function actionUpdate($user_id): array
    {
        $model = Broker::findOne(['user_id' => $user_id]);
        $role = \Yii::$app->user->id;
        $masterBroker = \Yii::$app->user->identity->findByRoleMaster($role);
        if (!$model || !$masterBroker) {
            throw new HttpException(404, \Yii::t('app', 'MasterId или UserId не найден!'));
        }else {
            $user = User::findOne(['id' => $model->user_id]);
            $user->load(\Yii::$app->getRequest()->post(), 'User');
            $user->status = $user::STATUS_ACTIVE;
            $user->update();
        }
        return $this->success($user->getAsArray(\api\templates\user\Large::class));
    }

    /**
     * @OA\Get(
     *     path="/invite-broker/{verification_token}",
     *     tags={"invite-broker"},
     *     operationId="getInviterBrokerLists",
     *     summary="getInviterBrokerLists",
     *     @OA\Parameter(
     *         name="verification_token",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
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
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/LoadSmall"
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

    public function actionInviter($verification_token)
    {
        $model = $this->findModels($verification_token);
        return $this->success($model->getAsArray(Inviter::class));
    }

    private function findModels($verification_token)
    {
        $con = ['verification_token' => $verification_token];
        $model = User::findOne($con);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $model;
    }

}